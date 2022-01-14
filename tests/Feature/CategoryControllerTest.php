<?php

namespace Tests\Feature;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\GodUsers;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use ViewAssertions, RefreshDatabase;

    /**
     * index tests
     */
    public function test_indexMethod_MustLoad_pages_categories_index_View()
    {
        $this->withoutMiddleware([Authenticate::class, GodUsers::class]);
        $this->expectViewFiles('pages.categories.index');
        $this->get('/categories');
    }


    public function test_indexMethod_MustPass_categories_arrayToView()
    {
        //
        //$this->withoutExceptionHandling();
        // $this->withoutMiddleware([Authenticate::class, GodUsers::class]);
        $user = User::factory()->create();
        Auth::loginUsingId(1);
        $response = $this->get('/categories');

        //$response->dumpHeaders();

        //$response->dumpSession();

        //$response->dump();




        $response->assertViewHas( 'categories');
        $response->assertStatus(200);
    }

    /**
     * addCategory tests
     */
    public function test_addCategoryMethod_MustLoad_pages_categories_add_View()
    {
        $this->withoutMiddleware([Authenticate::class, GodUsers::class]);
        $this->expectViewFiles('pages.categories.add');
        $this->get('/category/add');
    }

    /**
     * editCategory tests
     */


    /**
     * insertCategory tests
     */


    /**
     * updateCategory tests
     */


    /**
     * deleteCategory tests
     */



}
