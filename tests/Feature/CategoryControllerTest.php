<?php

namespace Tests\Feature;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\GodUsers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use ViewAssertions;

    /**
     * index tests
     */
    public function test_indexMethod_MustLoad_pages_categories_index_View()
    {
        $this->withoutMiddleware([Authenticate::class, GodUsers::class]);
        $this->expectViewFiles('pages.categories.index');
        $this->get('/categories');
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
