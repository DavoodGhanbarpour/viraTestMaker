<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Continue_;

class ExamController extends Controller
{
    public function index()
    {

        switch (Auth::user()->role) 
        {
            case 'STUDENT':
                return $this->studentExams();
                break;

            case 'TEACHER':
                return $this->teacherExams();
            break;

            case 'ADMIN':
                return $this->adminExams();
                break;
        }
    }


    public function examsScoresByStudent($examID)
    {
        $params['exams'] =  DB::table('exams')->
        join('assignees', 'assignees.classID', '=', 'exams.classID')->
        join('users', 'assignees.studentID', '=', 'users.id')->
        join('scores', 'scores.examID', '=', 'exams.id')->
        join('scores_detail', 'scores_detail.scoreID', '=', 'scores.id')->
        select([ 'scores.timeStart', 'scores.timeFinish', 'users.name as studentName', 'exams.id', 'users.id as studentID' ])->
        selectRaw('SUM(scoreIfCorrect) as sumOfCorrectScores')->
        where([ 
            [ 'exams.id', '=', $examID ], 
            [ 'assignees.trash', '<>', trashed() ], 
            [ 'users.trash', '<>', trashed() ], 
            [ 'exams.trash', '<>', trashed() ], 
            [ 'scores.trash', '<>', trashed() ], 
            [ 'scores_detail.trash', '<>', trashed() ], 
            [ 'scores.timeFinish', '<>', '0' ], 
        ])->groupBy('scores.studentID')->get()->toArray();

        foreach ($params['exams'] as &$value) 
            $value->hasDescriptionQuestionWithoutAnswer = $this->hasDescriptionQuestionWithoutAnswer($examID,$value->studentID);

        return view('pages.exams.studentsResults', $params);
    }

    private function hasDescriptionQuestionWithoutAnswer($examID,$studentID)
    {
        $result =  DB::table('scores')->
        join('scores_detail', 'scores_detail.scoreID', '=', 'scores.id')->
        join('questions', 'questions.id', '=', 'scores_detail.questionID')->
        where([ 
            [ 'scores_detail.trash', '<>', trashed() ], 
            [ 'scores_detail.scoreIfCorrect', '=', '0' ], 
            [ 'scores.trash', '<>', trashed() ], 
            [ 'scores.examID', '=', $examID ], 
            [ 'scores.studentID', '=', $studentID ], 
            [ 'questions.trash', '<>', trashed() ], 
            [ 'questions.type', '=', 'description' ], 
        ])->get()->first();

        if( $result )  
            return true;
        else
            return false;
    }

    public function examsOfAClass($classID)
    {
        $params['exams'] =  DB::table('exams')->
        join('classes', 'classes.id', '=', 'exams.classID')->
        join('users', 'users.id', '=', 'classes.teacherID')->
        join('courses', 'courses.id', '=', 'classes.courseID')->
        join('semesters', 'semesters.id', '=', 'classes.semesterID')->
        join('assignees', 'assignees.classID', '=', 'exams.classID')->
        select([ 'users.name as teacherName', 'courses.title as courseTitle', 'exams.*', 'classes.title as classTitle', 'semesters.title as semesterTitle' ])->
        where([ 
            [ 'classes.id', '=', $classID ], 
            [ 'assignees.studentID', '=', Auth::user()->id ], 
            [ 'assignees.trash', '<>', trashed() ], 
            [ 'classes.trash', '<>', trashed() ], 
            [ 'courses.trash', '<>', trashed() ], 
            [ 'users.trash', '<>', trashed() ], 
            [ 'exams.trash', '<>', trashed() ], 
        ])->get()->toArray();
            
        return view('pages.exams.general', $params);
    }

    public function adminExams()
    {
        $params['exams'] =  DB::table('exams')->
        join('classes', 'classes.id', '=', 'exams.classID')->
        join('users', 'users.id', '=', 'classes.teacherID')->
        join('courses', 'courses.id', '=', 'classes.courseID')->
        join('semesters', 'semesters.id', '=', 'classes.semesterID')->
        select([ 'users.name as teacherName', 'courses.title as courseTitle', 'exams.*', 'classes.title as classTitle', 'semesters.title as semesterTitle' ])->
        where([ 
            [ 'classes.trash', '<>', trashed() ], 
            [ 'courses.trash', '<>', trashed() ], 
            [ 'users.trash', '<>', trashed() ], 
            [ 'exams.trash', '<>', trashed() ], 
        ])->get()->toArray();
            
        return view('pages.exams.admin', $params);
    }

    public function teacherExams()
    {
        $params['exams'] =  DB::table('exams')->
        join('classes', 'classes.id', '=', 'exams.classID')->
        join('users', 'users.id', '=', 'classes.teacherID')->
        join('courses', 'courses.id', '=', 'classes.courseID')->
        join('semesters', 'semesters.id', '=', 'classes.semesterID')->
        select([ 'users.name as teacherName', 'courses.title as courseTitle', 'exams.*', 'classes.title as classTitle', 'semesters.title as semesterTitle' ])->
        where([ 
            [ 'classes.trash', '<>', trashed() ], 
            [ 'courses.trash', '<>', trashed() ], 
            [ 'users.trash', '<>', trashed() ], 
            [ 'exams.trash', '<>', trashed() ], 
            [ 'classes.teacherID', '=', Auth::user()->id ], 
        ])->get()->toArray();
               
        return view('pages.exams.admin', $params);
    }

    public function studentExams()
    {
        $params = [
            'exams'       => DB::table('exams')->select('*')->where('trash', '<>', trashed())->get()->toArray(),
        ];
        
        return view('pages.exams.student', $params);
    }


    public function addExam()
    {
        $params = [
            'classes'     => DB::table('classes')->select('*')->where('trash', '<>', trashed())->get()->toArray(),
        ];
        return view('pages.exams.add', $params);
    }

    public function addScore( $examID, $studentID )
    {
        $params     = [
            'questions'     => $this->getTextareaQuestionsByExamID( $examID, $studentID ) ?? [],
            'examID'        => $examID,
            'studentID'     => $studentID,
            'studentName'   => DB::table('users')->select('name')->where('id','=',$studentID)->get()->first()->name,
        ];

        if( !$params['questions'] )
            return back()->with('flashMessage',messageErrors( 415 ) );

        return view('pages.exams.scoreExams', $params);
    }


    
    public function insertScore( Request $request,$examID, $studentID )
    {
        $requests = $request->input();
        foreach ($requests['scoreForCorrectItems'] as $questionID => $score) 
        {
            $result = DB::table('scores_detail')->
            join('scores', 'scores.id', '=', 'scores_detail.scoreID')
            ->where([
                [ 'questionID', '=' ,$questionID ],
                [ 'studentID', '=' ,$studentID ],
                [ 'scores.trash', '<>' ,trashed() ],
                [ 'scores_detail.trash', '<>' ,trashed() ],
            ])
            ->update([ 'scoreIfCorrect' => $score ]);
        }


        return redirect('/exams')->with('flashMessage', messageErrors( 200 ) );
    }

    public function addQuestions($examID)
    {
        $params     = [
            'questions'     => $this->getQuestionsByExamID( $examID ) ?? [],
            'examID'        => $examID,
        ];
        return redirect('examsScoresByStudent')->with('flashMessage', messageErrors( 200 ) );
    }


    
    public function showResultOfExam($examID)
    {
        $params     = [
            'questions'         => $this->getQuestionsResultByExamID( $examID, Auth::user()->id ) ?? [],
            'examID'            => $examID,
            'totalScoreOfUser'  => $this->sumOfScoresAchived( $examID, Auth::user()->id )
        ];
        
        return view('pages.exams.result', $params);
    }

    private function sumOfScoresAchived($examID, $studentID)
    {
        return DB::table('scores_detail')->
        join('scores', 'scores.id', '=', 'scores_detail.scoreID')->
        where([
            [ 'studentID', '=' ,$studentID ],
            [ 'scores.examID', '=' ,$examID ],
            [ 'scores.trash', '<>' ,trashed() ],
            [ 'scores_detail.trash', '<>' ,trashed() ],
        ])->sum('scoreIfCorrect') ?? 0;
    }


    private function buildFakeOptionData($inp)
    {
        $options = [];
        switch ($inp) 
        {
            case 'multiOption':
                $options = [ [ 'optionTitle' => '', 'correctAnswer' => 'false' ],[ 'optionTitle' => '', 'correctAnswer' => 'false' ],[ 'optionTitle' => '', 'correctAnswer' => 'false' ],[ 'optionTitle' => '', 'correctAnswer' => 'false' ] ];
                break;

            case 'trueFalse':
                $options = [ [ 'optionTitle' => '', 'correctAnswer' => 'false' ],[ 'optionTitle' => '', 'correctAnswer' => 'false' ] ];
                break;

            case 'description':
                $options = [ [ 'optionTitle' => ''] ];
                break;
        }
        return json_decode( json_encode($options) );
    }
    
    public function insertQuestions( $examID, Request $request )
    {
        $inputs             = $request->input(); 
        $questionsMaster    = [];
        $questionsSlave     = [];

        foreach ($inputs['examQuestions'] as $value) 
        {
            if( $value['lastQuestionID'] )
            {
                DB::table('questions')
                ->where('id', '=' ,$value['lastQuestionID'])
                ->update([ 'trash' => trashed() ]);

                DB::table('questions_detail')
                ->where('questionID', '=' ,$value['lastQuestionID'])
                ->update([ 'trash' => trashed() ]);
            }
            $questionsMaster    = [
                'examID'        => $examID,
                'score'         => toEngNumbers( $value['score'] ),
                'title'         => $value['title'],
                'type'          => $value['questionType'],
            ];  
            
            $insertedID     = DB::table('questions')->insertGetId($questionsMaster);    
            if( !$insertedID )
                continue;
            $answersAsArray = ( extractAnswersOptionsFromArray($value) );
            foreach ( reset( $answersAsArray ) as $inputName => $title) 
            {
                $isCorrectAnswer = 'false';
                if( isset( $value['correctAnswer'] ) )
                {
                    $isCorrectAnswer    = filter_var($inputName, FILTER_SANITIZE_NUMBER_INT) == $value['correctAnswer'];
                    $isCorrectAnswer    = $isCorrectAnswer    ? 'true' : 'false';
                }
                $questionsSlave[]   = [
                    'questionID'    => $insertedID,
                    'title'         => $title ?? '',
                    'correctAnswer' => $isCorrectAnswer, 
                ];
            }

        }
        // varDumper($questionsSlave);
        $resultOfMultiInsert    = DB::table('questions_detail')->insert($questionsSlave);
   
        if( $resultOfMultiInsert )
            return redirect('/exams')->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }

    public function editExam( $examID )
    {
        $params = [
            'classes'       => DB::table('classes')->select('*')->where('trash', '<>', trashed())->get()->toArray(),
            'exam'          => DB::table('exams')->select('*')->where([ ['trash', '<>', trashed()],['id', '=', $examID] ])->get()->first()
        ];

        return view('pages.exams.edit', $params);
    }

    
    public function updateExamQuestionResult( Request $request,$draftQuestionID, $moveType )
    {

        $examData =  DB::table('scores_detail')->
        select([ 'scores.id as scoreMasterID','scores.examID', 'scores_detail.id as scoreDraftID' ])->
        join('scores', 'scores.id', '=', 'scores_detail.scoreID')->
        where([ 
            [ 'scores_detail.trash', '<>', trashed() ], 
            [ 'scores.trash', '<>', trashed() ], 
            [ 'scores_detail.questionID', '=', $draftQuestionID ], 
        ])->get()->first() ?? null;
        
        if( !$examData->examID ) 
            return back()->with('flashMessage',messageErrors( 411 ) );

        
        $inputs = $request->input();
        $affected = DB::table('scores_detail')
        ->where('questionID', '=' ,$draftQuestionID)
        ->where('trash', '<>' ,trashed())
        ->update([ 'answer' => $inputs['correctAnswer'], 'answerTime' => time(),
            'scoreIfCorrect' => $this->getScoreOfQuestion( $inputs['correctAnswer'] )
        ]);

        if( $moveType == 'finish' )
            if( $this->finishExam( $examData->examID ) )
                return redirect('dashboard')->with('flashMessage',messageErrors( 200 ) );


        $nextOrPrevID = $this->nextOrPrevID( $examData->scoreDraftID , $examData->scoreMasterID );

        if( $nextOrPrevID[ $moveType ] )
            $questionToShow = $nextOrPrevID[ $moveType ];
        else
            $questionToShow = $examData->scoreDraftID;
        

        if( $affected )
            return $this->attendance( $examData->examID, $questionToShow );
        else
            return back()->with('flashMessage',messageErrors( 412 ) );
    }

    private function getScoreOfQuestion ( $questionID )
    {
        $qeustionData =  DB::table('questions_detail')->
        join('questions', 'questions.id', '=', 'questions_detail.questionID')->
        select([ 'questions.score' ])->
        where([ 
            [ 'questions_detail.trash', '<>', trashed() ], 
            [ 'questions.trash', '<>', trashed() ], 
            [ 'questions_detail.id', '=', $questionID ], 
            [ 'questions_detail.correctAnswer', '=', 'true' ],
        ])->get()->first() ?? null;

        if( $qeustionData->score )
            return $qeustionData->score;
        else 
            return 0;
    }

    private function nextOrPrevID($scoreDetailID, $scoreID)
    {
        $previous   = DB::table('scores_detail')->where([[ 'scoreID', '=', $scoreID ], [ 'id', '<', $scoreDetailID ] ])->max('id');
        $next       = DB::table('scores_detail')->where([[ 'scoreID', '=', $scoreID ], [ 'id', '>', $scoreDetailID ] ])->min('id');

        return [ 'next' => $next, 'prev' => $previous ];
    }

    private function finishExam( $examID )
    {
        $affected = DB::table('scores')
        ->where('examID', '=' ,$examID)
        ->where('trash', '<>' ,trashed())
        ->update([ 'timeFinish' => time() ]);

        if( !$affected )
            return true;
        else
            return back()->with('flashMessage',messageErrors( 412 ) );
    }

    
    public function deleteExam( $examID )
    {
        $affected = DB::table('exams')
            ->where('id', '=' ,$examID)
            ->update([ 'trash' => trashed() ]);

        $affected = DB::table('questions')
        ->where('examID', '=' ,$examID)
        ->update([ 'trash' => trashed() ]);

        
        $affected = DB::table('questions')
        ->where('examID', '=' ,$examID)
        ->update([ 'trash' => trashed() ]);


        if( $affected )
            return back()->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }


    public function insertExam( Request $request ) 
    {
        $inputs         = $request->input(); 
        $dataToInsert   = [
            'title'             => $inputs['title'],
            'classID'           => $inputs['class'],
            'score'             => toEngNumbers($inputs['score']),
            'dateStart'         => datepickerToTimestamp($inputs['dateStart']),
            'dateFinish'        => datepickerToTimestamp($inputs['dateFinish']),
            'timeStart'         => timepickerToTimestamp($inputs['timeStart']),
            'timeFinish'        => timepickerToTimestamp($inputs['timeFinish']),
            'isRandom'          => $inputs['random'] == 'TRUE' ? 'true' : 'false',
            'isReviewAllowed'   => $inputs['random'] == 'TRUE' ? 'true' : 'false',
        ];

        if( $this->isThisDayHasExam( $dataToInsert['dateStart'], $dataToInsert['dateFinish'], $dataToInsert['classID'] ) )
            return back()->with('flashMessage', messageErrors( 409 ) );

            
        if( !$this->isStartIsLowerThanFinish( $dataToInsert['dateStart'], $dataToInsert['dateFinish'] ) || 
            !$this->isStartIsLowerThanFinish( $dataToInsert['timeStart'], $dataToInsert['timeFinish'] ) )
            return back()->with('flashMessage', messageErrors( 410 ) );
            
        $insertedID = DB::table('exams')->insertGetId($dataToInsert);

        if( $insertedID )
            return redirect('/exams')->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }

    public function updateExam( $examID, Request $request )
    {
        $inputs         = $request->input(); 
        $dataToUpdate   = [
            'title'             => $inputs['title'],
            'classID'           => $inputs['class'],
            'score'             => toEngNumbers($inputs['score']),
            'dateStart'         => datepickerToTimestamp($inputs['dateStart']),
            'dateFinish'        => datepickerToTimestamp($inputs['dateFinish']),
            'timeStart'         => timepickerToTimestamp($inputs['timeStart']),
            'timeFinish'        => timepickerToTimestamp($inputs['timeFinish']),
            'isRandom'          => $inputs['random'] == 'TRUE' ? 'true' : 'false',
            'isReviewAllowed'   => $inputs['random'] == 'TRUE' ? 'true' : 'false',
        ];

        if( $this->isThisDayHasExam( $dataToUpdate['dateStart'], $dataToUpdate['dateFinish'], $dataToUpdate['classID'], $examID ) )
            return back()->with('flashMessage', messageErrors( 409 ) );

            
        if( !$this->isStartIsLowerThanFinish( $dataToUpdate['dateStart'], $dataToUpdate['dateFinish'] ) || 
            !$this->isStartIsLowerThanFinish( $dataToUpdate['timeStart'], $dataToUpdate['timeFinish'] ) )
            return back()->with('flashMessage', messageErrors( 410 ) );

        $insertedID  = DB::table('exams')->where('id',$examID)->update($dataToUpdate);

        if( $insertedID )
            return redirect('/exams')->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }


    private function isThisDayHasExam($dateStart,$dateFinish,$classID,$rowID = 0) : bool
    {
        $where = [ 
            [ 'dateStart', '<=', $dateStart ],
            [ 'dateFinish', '>=', $dateFinish ],
            [ 'classID', '=', $classID ],
            [ 'id', '<>', $rowID ],
            [ 'trash', '<>', trashed() ],
         ];

        return DB::table('exams')->where($where)->exists();
    }


    
    private function isStartIsLowerThanFinish( $start, $finish ) : bool
    {
        if( $start <= $finish )
            return true;
        else
            return false;
    }



       
    private function getExamDetail($examID)
    {
        return DB::table('exams')->
        select([ 'exams.*' ])->
        where([ 
            [ 'exams.id', '=', $examID ],
            [ 'exams.trash', '<>', trashed() ],
        ])->get()->first();
        
    }

    private function isExamHasFinishTime($examID)
    {
        $isFinish =  DB::table('scores')->
        select([ 'scores.timeFinish' ])->
        where([ 
            [ 'scores.examID', '=', $examID ],
            [ 'scores.trash', '<>', trashed() ],
        ])->get()->first();
        
        if( $isFinish->timeFinish )
            return true;
        else
            return false;
    }


    

    public function attendance($examID, $questionToShowID = null)
    {
        
        $examDetails        = $this->getExamDetail($examID);
        if( $examDetails->timeFinish + $examDetails->dateFinish <= time() ) 
        {
            if( !$this->isExamHasFinishTime($examID) )
                if( $this->finishExam( $examID ) )
                    return back()->with('flashMessage', messageErrors( 414 ) );
            else
                return back()->with('flashMessage', messageErrors( 413 ) );
        }

        $wasExamFinished    = $this->isUserHadFinishExam($examID);
        if( $wasExamFinished )
            return back()->with('flashMessage', messageErrors( 413 ) );

        $hasDraft           = $this->isUserHasActiveDraft($examID);
        
        if( !$hasDraft )
        {
            $questionDetails    = $this->buildDraftForActiveUser($examID); 
            $hasDraft           = $this->isUserHasActiveDraft($examID);
        }




        if( $hasDraft )
        {
            if( $questionToShowID )
                $questionDetails = $this->getQuestionsByDraftDetailID($questionToShowID);
                
            else
                $questionDetails = $this->getQuestionsByDraftID($hasDraft);
        }


        $params = [
            'questionsDetails'  => $questionDetails,
            'examDetails'       => $examDetails,
        ];

        if( $hasDraft )
        {
            $params['isLastQuestion']       = $this->isLastQuestion( $hasDraft, $questionDetails['master']->id );
            $params['isFirstQuestion']      = $this->isFirstQuestion( $hasDraft, $questionDetails['master']->id );
            $params['draftDetail']          = $this->getDraftData( $hasDraft );
        }



        return view('pages.exams.attendance', $params);
    }

    private function isLastQuestion($draftID, $questionID)
    {
        $orderOfQuestion  = DB::table('scores')->
        join('scores_detail', 'scores.id', '=', 'scores_detail.scoreID')
        ->select('scores_detail.number')
        ->where([ 
            ['scores.id', '=', $draftID],
            ['scores.trash', '<>', trashed()],
            ['scores_detail.trash', '<>', trashed()],
        ])->get()->max('number');


        $currentNumber = DB::table('scores_detail')->select('number')->where([ ['scores_detail.questionID', '=', $questionID] ])->first()->number;
    
        if( $currentNumber == $orderOfQuestion )
            return true;

        return false;
    }

    private function isFirstQuestion($draftID, $questionID)
    {
        $orderOfQuestion  = DB::table('scores')->
        join('scores_detail', 'scores.id', '=', 'scores_detail.scoreID')
        ->select('scores_detail.number')
        ->where([ 
            ['scores.id', '=', $draftID],
            ['scores.trash', '<>', trashed()],
            ['scores_detail.trash', '<>', trashed()],
        ])->get()->min('number');

        $currentNumber = DB::table('scores_detail')->select('number')->where([ ['scores_detail.questionID', '=', $questionID] ])->first()->number;

      
        if( $currentNumber == $orderOfQuestion )
            return true;

        return false;
    }

    private function isUserHasActiveDraft($examID)
    {
        $isAvailable = DB::table('scores')->
        select([ 'id' ])->
        where([ 
            [ 'examID', '=', $examID ],
            [ 'studentID', '=', Auth::user()->id ],
            [ 'timeFinish', '=', '0' ],
            [ 'trash', '<>', trashed() ],
        ])->get()->first();
        
        if( $isAvailable )
            return $isAvailable->id;
        else
            return false;
    }


    
    private function getDraftData($draftID)
    {
        $isAvailable = DB::table('scores')->
        select([ '*' ])->
        where([ 
            [ 'id', '=', $draftID ],
            [ 'studentID', '=', Auth::user()->id ],
            [ 'trash', '<>', trashed() ],
        ])->get()->first();
        
        if( $isAvailable )
            return $isAvailable;
        else
            return false;
    }
    
    private function isUserHadFinishExam($examID)
    {
        $isAvailable = DB::table('scores')->
        select([ 'id' ])->
        where([ 
            [ 'examID', '=', $examID ],
            [ 'studentID', '=', Auth::user()->id ],
            [ 'timeFinish', '!=', '0' ],
            [ 'trash', '<>', trashed() ],
        ])->get()->first();
        
        if( $isAvailable )
            return $isAvailable->id;
        else
            return false;
    }

    private function isExamRandom( $examID ) : bool
    {
        $isRandom = DB::table('exams')->
        select([ 'isRandom' ])->
        where([ 
            [ 'exams.id', '=', $examID ],
            [ 'exams.trash', '<>', trashed() ],
        ])->get()->first();
        
        if( $isRandom->isRandom == 'true' )
            return true;
        else
            return false;
    }


    private function buildDraftForActiveUser( $examID ) : bool
    {
        $questions              = $this->randomizeQuestionsIfNeeded( $examID, $this->getQuestionsByExamID( $examID ) );
        

        $masterTableData    = [
            'examID'        => $examID,
            'studentID'     => Auth::user()->id,
            'timeStart'     => time(),
            'timeFinish'    => '0',
        ];

        $insertedID             = DB::table('scores')->insertGetId($masterTableData);
        if( !$insertedID )
            return false;

        $index = 1;
        foreach ($questions as $value) 
        {
            $slaveTableData[]    = [
                'scoreID'               => $insertedID,
                'questionID'            => $value['id'],
                'answer'                => 0,
                'answerTime'            => 0,
                'number'                => $index++
            ];
        }
        $resultOfMultiInsert    = DB::table('scores_detail')->insert($slaveTableData);
        if( !$resultOfMultiInsert )
            return false;


        return true;
        
    }

    private function randomizeQuestionsIfNeeded( $examID, $questions )
    {
        $isRandom          = $this->isExamRandom( $examID );
        if( !$isRandom ) 
            return $questions;
        shuffle( $questions );
        foreach ($questions as &$value) 
            shuffle( $value['slavesMultiOption'] );

        return $questions;
    }

    private function getQuestionsByExamID( $examID )
    {
        $groupedQuestinos  = [];
        $questions         = DB::table('questions')->
        join('questions_detail', 'questions.id', '=', 'questions_detail.questionID')->
        join('exams', 'exams.id', '=', 'questions.examID')->
        select([ 
            'questions.*',
            'questions.title as questionsTitle',
            'questions.id as masterID',
            'questions_detail.correctAnswer',
            'questions_detail.title as optionTitle',
            'questions.examID',
            'questions_detail.questionID',
            'questions_detail.id as slaveID' 
        ])->
        where([ 
            [ 'exams.id', '=', $examID ], 
            [ 'questions.trash', '<>', trashed() ], 
            [ 'questions_detail.trash', '<>', trashed() ], 
        ])->get()->toArray();
        

        foreach ($questions as $value) 
        {
            $groupedQuestinos[ $value->questionID ]['id']               = $value->id;
            $groupedQuestinos[ $value->questionID ]['title']            = $value->questionsTitle;
            $groupedQuestinos[ $value->questionID ]['score']            = $value->score;
            $groupedQuestinos[ $value->questionID ]['questionType']     = $value->type;

            if(  $value->type == 'multiOption' )
                $groupedQuestinos[ $value->questionID ]['slavesMultiOption'][]  = $value;
            else
                $groupedQuestinos[ $value->questionID ]['slavesMultiOption']    = $this->buildFakeOptionData('multiOption');

            if(  $value->type == 'trueFalse' )
                $groupedQuestinos[ $value->questionID ]['slavesTrueFlase'][]    = $value;
            else
                $groupedQuestinos[ $value->questionID ]['slavesTrueFlase']      = $this->buildFakeOptionData('trueFalse');

            if(  $value->type == 'description' )
                $groupedQuestinos[ $value->questionID ]['slavesDescription'][]  = $value;
            else
                $groupedQuestinos[ $value->questionID ]['slavesDescription']    = $this->buildFakeOptionData('description');
        }

        return $groupedQuestinos;
    }

    private function getTextareaQuestionsByExamID( $examID, $studentID )
    {
        $groupedQuestinos  = [];
        $questions         = DB::table('questions')->
        join('questions_detail', 'questions.id', '=', 'questions_detail.questionID')->
        join('exams', 'exams.id', '=', 'questions.examID')->
        join('scores', 'scores.examID', '=', 'exams.id')->
        join('scores_detail', 'scores_detail.scoreID', '=', 'scores.id')->
        select([ 
            'questions.*',
            'questions.title as questionsTitle',
            'questions.id as masterID',
            'questions_detail.correctAnswer',
            'questions_detail.title as optionTitle',
            'questions.examID',
            'questions_detail.questionID',
            'questions_detail.id as slaveID',
            'scores_detail.scoreIfCorrect as scoreIfCorrect',
        ])->
        where([ 
            [ 'exams.id', '=', $examID ], 
            [ 'scores.studentID', '=', $studentID ], 
            [ 'questions.type', '=', 'description' ], 
            [ 'questions.trash', '<>', trashed() ], 
            [ 'scores_detail.trash', '<>', trashed() ], 
            [ 'questions_detail.trash', '<>', trashed() ], 
        ])->get()->toArray();
        

        foreach ($questions as $value) 
        {
            $groupedQuestinos[ $value->questionID ]['id']               = $value->id;
            $groupedQuestinos[ $value->questionID ]['title']            = $value->questionsTitle;
            $groupedQuestinos[ $value->questionID ]['score']            = $value->score;
            $groupedQuestinos[ $value->questionID ]['questionType']     = $value->type;

            if(  $value->type == 'multiOption' )
                $groupedQuestinos[ $value->questionID ]['slavesMultiOption'][]  = $value;
            else
                $groupedQuestinos[ $value->questionID ]['slavesMultiOption']    = $this->buildFakeOptionData('multiOption');

            if(  $value->type == 'trueFalse' )
                $groupedQuestinos[ $value->questionID ]['slavesTrueFlase'][]    = $value;
            else
                $groupedQuestinos[ $value->questionID ]['slavesTrueFlase']      = $this->buildFakeOptionData('trueFalse');

            if(  $value->type == 'description' )
                $groupedQuestinos[ $value->questionID ]['slavesDescription'][]  = $value;
            else
                $groupedQuestinos[ $value->questionID ]['slavesDescription']    = $this->buildFakeOptionData('description');
        }

        return $groupedQuestinos;
    }


    private function getQuestionsResultByExamID( $examID, $studentID )
    {
        $groupedQuestinos  = [];
        $questions         = DB::table('questions')->
        join('questions_detail', 'questions.id', '=', 'questions_detail.questionID')->
        join('exams', 'exams.id', '=', 'questions.examID')->
        join('scores', 'scores.examID', '=', 'exams.id')->
        join('scores_detail', 'scores_detail.scoreID', '=', 'scores.id')->
        select([ 
            'questions.*',
            'questions.title as questionsTitle',
            'questions.id as masterID',
            'questions_detail.correctAnswer',
            'questions_detail.title as optionTitle',
            'questions.examID',
            'questions_detail.questionID',
            'questions_detail.id as slaveID',
            'scores_detail.scoreIfCorrect as scoreIfCorrect',
        ])->
        where([ 
            [ 'exams.id', '=', $examID ], 
            [ 'scores.studentID', '=', $studentID ], 
            [ 'questions.trash', '<>', trashed() ], 
            [ 'scores_detail.trash', '<>', trashed() ], 
            [ 'questions_detail.trash', '<>', trashed() ], 
        ])->get()->toArray();
        

        foreach ($questions as $value) 
        {
            $groupedQuestinos[ $value->questionID ]['id']               = $value->id;
            $groupedQuestinos[ $value->questionID ]['title']            = $value->questionsTitle;
            $groupedQuestinos[ $value->questionID ]['score']            = $value->score;
            $groupedQuestinos[ $value->questionID ]['questionType']     = $value->type;

            if(  $value->type == 'multiOption' )
                $groupedQuestinos[ $value->questionID ]['slavesMultiOption'][]  = $value;
            else
                $groupedQuestinos[ $value->questionID ]['slavesMultiOption']    = $this->buildFakeOptionData('multiOption');

            if(  $value->type == 'trueFalse' )
                $groupedQuestinos[ $value->questionID ]['slavesTrueFlase'][]    = $value;
            else
                $groupedQuestinos[ $value->questionID ]['slavesTrueFlase']      = $this->buildFakeOptionData('trueFalse');

            if(  $value->type == 'description' )
                $groupedQuestinos[ $value->questionID ]['slavesDescription'][]  = $value;
            else
                $groupedQuestinos[ $value->questionID ]['slavesDescription']    = $this->buildFakeOptionData('description');
        }

        return $groupedQuestinos;
    }



    private function getQuestionsByDraftDetailID( $draftDetailID )
    {
        $questionID             = $this->getQuestionsIDByDraftDetailID($draftDetailID);

        $questionsMasterDetails = DB::table('questions')->
        join('questions_detail', 'questions.id', '=', 'questions_detail.questionID')->select('questions.*')->
        where([ 
            [ 'questions.trash', '<>', trashed() ],
            [ 'questions.id', '=', $questionID->questionID ],
            [ 'questions_detail.trash', '<>', trashed() ],
        ])->get()->first();

        // ---------------------------------------------------------------------------------------- //
        
        $questionsSlaveDetails = DB::table('questions_detail')->select('*')->
        where([ 
            [ 'questions_detail.questionID', '=', $questionsMasterDetails->id ],
            [ 'questions_detail.trash', '<>', trashed() ],
        ])->get()->toArray();


        return [ 'slaves' => $questionsSlaveDetails, 'master' => $questionsMasterDetails ];
    }
    
    private function getQuestionsByDraftID( $draftID )
    {
        $questionIDs            = $this->convertObjToSingleArray( $this->getQuestionsIDByDraftID($draftID) );
        
        $questionsMasterDetails = DB::table('questions')->
        join('questions_detail', 'questions.id', '=', 'questions_detail.questionID')->select('questions.*')->
        where([ 
            [ 'questions.trash', '<>', trashed() ],
            [ 'questions_detail.trash', '<>', trashed() ],
        ])->
        whereIn('questions.id',$questionIDs)->get()->first();

        // ---------------------------------------------------------------------------------------- //
        
        $questionsSlaveDetails = DB::table('questions_detail')->select(['questions_detail.*','scores_detail.number'])->
        join('scores_detail', 'questions_detail.questionID', '=', 'scores_detail.questionID')->
        where([ 
            [ 'questions_detail.questionID', '=', $questionsMasterDetails->id ],
            [ 'scores_detail.trash', '<>', trashed() ],
            [ 'questions_detail.trash', '<>', trashed() ],
        ])->get()->toArray();


        return [ 'slaves' => $questionsSlaveDetails, 'master' => $questionsMasterDetails ];
    }


    private function getQuestionsIDByDraftDetailID($draftDetailID)
    {
        $questionIDs  = DB::table('scores_detail')
        ->select('scores_detail.questionID')
        ->where([ 
            ['scores_detail.id', '=', $draftDetailID],
            ['scores_detail.trash', '<>', trashed()],
        ])->get()->first();

        return $questionIDs;
    }
    
    private function getQuestionsIDByDraftID($draftID)
    {
        $questionIDs  = DB::table('scores')->
        join('scores_detail', 'scores.id', '=', 'scores_detail.scoreID')
        ->select('scores_detail.questionID')
        ->where([ 
            ['scores.id', '=', $draftID],
            ['scores.trash', '<>', trashed()],
            ['scores_detail.trash', '<>', trashed()],
        ])->orderBy('questionID')->get()->toArray();

        return $questionIDs;
    }


    private function convertObjToSingleArray($objs)
    {
        $result = [];
        foreach ($objs as $eachObj) 
            $result[] = $eachObj->questionID;

        return $result;
    }





    


    

}
