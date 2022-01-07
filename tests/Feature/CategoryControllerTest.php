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

    public function test_addCategoryMethod_MustLoad_pages_categories_add_View()
    {
        $this->withoutMiddleware([Authenticate::class, GodUsers::class]);
        $this->expectViewFiles('pages.categories.add');
        $this->get('/category/add');
    }

}
