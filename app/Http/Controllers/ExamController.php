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


    public function examsOfAClass($classID)
    {
        $params['exams'] =  DB::table('exams')->
        join('classes', 'classes.id', '=', 'exams.classID')->
        join('users', 'users.id', '=', 'classes.teacherID')->
        join('courses', 'courses.id', '=', 'classes.courseID')->
        join('semesters', 'semesters.id', '=', 'classes.semesterID')->
        select([ 'users.name as teacherName', 'courses.title as courseTitle', 'exams.*', 'classes.title as classTitle', 'semesters.title as semesterTitle' ])->
        where([ 
            [ 'classes.id', '=', $classID ], 
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
        $params = [
            'exams'       => DB::table('exams')->select('*')->where('trash', '<>', trashed())->get()->toArray(),
        ];
        
        return view('pages.exams.teacher', $params);
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

    public function addQuestions($examID)
    {
        
    
        $params     = [
            'questions'     => $this->getQuestionsByExamID( $examID ),
            'examID'        => $examID,
        ];
        return view('pages.exams.addQuestions', $params);
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
                'score'         => $value['score'],
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
                    'title'         => $title,
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


    
    public function deleteExam( $courseID )
    {
        $affected = DB::table('Exams')
            ->where('id', '=' ,$courseID)
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
            'timesToTry'        => toEngNumbers($inputs['timesToTry']),
            'dateStart'         => datepickerToTimestamp($inputs['dateStart']),
            'dateFinish'        => datepickerToTimestamp($inputs['dateFinish']),
            'timeStart'         => timepickerToTimestamp($inputs['timeStart']),
            'timeFinish'        => timepickerToTimestamp($inputs['timeFinish']),
            'isRandom'          => $inputs['random'] == 'TRUE' ? 'true' : 'false',
            'isReviewAllowed'   => $inputs['random'] == 'TRUE' ? 'true' : 'false',
            'isMoveAllowed'     => $inputs['random'] == 'TRUE' ? 'true' : 'false',
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
            'timesToTry'        => toEngNumbers($inputs['timesToTry']),
            'dateStart'         => datepickerToTimestamp($inputs['dateStart']),
            'dateFinish'        => datepickerToTimestamp($inputs['dateFinish']),
            'timeStart'         => timepickerToTimestamp($inputs['timeStart']),
            'timeFinish'        => timepickerToTimestamp($inputs['timeFinish']),
            'isRandom'          => $inputs['random'] == 'TRUE' ? 'true' : 'false',
            'isReviewAllowed'   => $inputs['random'] == 'TRUE' ? 'true' : 'false',
            'isMoveAllowed'     => $inputs['random'] == 'TRUE' ? 'true' : 'false',
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

    

    public function attendance($examID)
    {
        $examDetails        = $this->getExamDetail($examID);
        $hasDraft           = $this->isUserHasActiveDraft();
        if( !$hasDraft )
        {
            $questionDetails    = $this->buildDraftForActiveUser($examID); 
            $hasDraft           = $this->isUserHasActiveDraft();
        }




        if( $hasDraft )
            $questionDetails = $this->getQuestionsByDraftID($hasDraft);



        $params = [
            'questionsDetails' => $questionDetails,
            'examDetails'       => $examDetails,
        ];

        return view('pages.exams.attendance', $params);
    }

    private function isUserHasActiveDraft()
    {
        $isAvailable = DB::table('scores')->
        select([ 'id' ])->
        where([ 
            [ 'studentID', '=', Auth::user()->id ],
            [ 'timeFinish', '=', '0' ],
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

        foreach ($questions as $value) 
        {
            $slaveTableData[]    = [
                'scoreID'               => $insertedID,
                'questionID'            => $value['id'],
                'answer'                => 0,
                'answerTime'            => 0,
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
        
        $questionsSlaveDetails = DB::table('questions_detail')->select('*')->
        where([ 
            [ 'questions_detail.questionID', '=', $questionsMasterDetails->id ],
            [ 'questions_detail.trash', '<>', trashed() ],
        ])->get()->toArray();


        return [ 'slaves' => $questionsSlaveDetails, 'master' => $questionsMasterDetails ];
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
