<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobworkController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use PHPUnit\Framework\Test;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\ReviewHomeController;
use App\Http\Controllers\PrivilegeController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\ContactController;
use App\Models\PastWork;
use App\Models\PastWorkTag;
use App\Models\Faq;
use App\Models\PageVariable;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'th', 'cn'])) {
        abort(400);
    }
    Cookie::queue(Cookie::make('locale', $locale, 60 * 24 * 365));
    // Session::put('locale', $locale);
    return redirect()->back();
})->name('lang.change');

Route::get('/', function () {
    $latestArticles = ArticleController::get_latest_articles(6);

    $faqs = Faq::all();
    foreach ($faqs as $faq) {
        $faq->translation = $faq->translation();
        $faq->tags = $faq->faqTags->map(function ($tag) {
            return $tag->translation();
        });
    }

    $pageVariables = PageVariable::where('page', 'home')->first()->toArray();
    $var = $pageVariables['var'] ?? []; // Default value if not set

    return view('home.index', compact('faqs', 'latestArticles', 'var'));
});

Route::get('/hinspector', function () {
    return view('home.service.Hinspector');
});

Route::group([], function () {
    Route::prefix('{path}')->whereIn('path', ['hinterior', 'hconstruction'])->group(function () {
        Route::get('/', function ($path) {
            $projects = PastWork::where('page', $path)->get();
            $tags = PastWorkTag::where('page', $path)->get();
            foreach ($projects as $project) {
                $project->translation = $project->translation();
                $project->tag = $project->pastWorkTag;
                $project->tag->translation = $project->tag->translation();
            }
            foreach ($tags as $tag) {
                $tag->translation = $tag->translation();
            }

            $viewName = match ($path) {
                // 'hinspector' => 'home.service.Hinspector',
                'hinterior' => 'home.service.Hinterior',
                'hconstruction' => 'home.service.Hconstruction',
                default => abort(404),
            };
            return view($viewName, compact('projects', 'tags'));
        });

        Route::get('/project/{id}', function ($path, $id) {
            $project = PastWork::find($id);
            if (!$project || $project->page !== $path) {
                abort(404);
            }
            $project->translation = $project->translation();
            $project->tag = $project->pastWorkTag;
            $project->tag->translation = $project->tag->translation();
            return view('home.service.view_project', compact('project'));
        });
    });
});

Route::get('/hbutler', function () {
    return view('home.service.HbutlerComingSoon');
});


Route::get('/contactus', function () {
    return view('home.contact.contactus');
});

Route::get('/joinwithus', [JobworkController::class, 'view_jobwork'])->name('joinwithus');


Route::get('/ourteam', [DepartmentController::class, 'ourteam'])->name('ourteam');

Route::get('/ourstory', function () {
    return view('home.aboutus.ourstory');
});


Route::get('/admin/compare', [HouseController::class, 'adminView']);

Route::get('/admin/houses', [HouseController::class, 'adminView'])->name('admin.houses.list');
Route::post('/admin/houses', [HouseController::class, 'store'])->name('admin.houses.store');

Route::prefix('addon_service')->group(function () {
    Route::get('/app_inspector', function () {
        return view('home.addon_service.app_inspector');
    });
    Route::get('/cal_electric', function () {
        return view('home.addon_service.cal_electric');
    });
    Route::get('/checklist', function () {
        return view('home.addon_service.checklist');
    });
});
// Route::get('review_home/{id}', function ($id) {
//     return view('home.article.review_home', ['id' => $id]);
// });

Route::prefix('article')->controller(ArticleController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/detail', 'show_article')->name('article.show');
});

Route::prefix('review')->controller(ReviewHomeController::class)->group(function () {
    Route::get('/', 'index')->name('review_home.index');
    Route::get('/detail', 'show')->name('review_home.show');
});

Route::prefix('privilege')->controller(PrivilegeController::class)->group(function () {
    Route::get('/', 'index')->name('review_home.index');
    Route::get('/detail', 'show')->name('review_home.show');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::prefix('static_page')->controller(StaticPageController::class)->group(function () {
        Route::get('/', 'index')->name('admin.static_page.index');
        Route::get('/home', 'home')->name('admin.static_page.home');
        Route::post('/home', 'home_store')->name('admin.static_page.home_store');

        Route::prefix('project/{pageName}')->group(function () {
            Route::get('/', 'manage_project')->name('admin.static_page.manage_project');
            Route::get('/create', 'create_project_view')->name('admin.static_page.create_project_view');
            Route::get('/edit/{id}', 'edit_project_view')->name('admin.static_page.edit_project_view');
            Route::post('/', 'create_project')->name('admin.static_page.create_project');
            Route::delete('/{id}', 'delete_project')->name('static_page.faq.delete_project');
            Route::put('/{id}', 'edit_project')->name('admin.static_page.edit_project');
            Route::put('/edit_lang/{id}', 'edit_project_lang')->name('admin.static_page.edit_project_lang');

            Route::post('/add_tag', 'create_tag')->name('admin.faq.add_tag');
            Route::put('/edit_tag/{id}', 'edit_tag')->name('admin.faq.edit_tag');
            Route::delete('/delete_tag/{id}', 'delete_tag')->name('admin.faq.delete_tag');
        });
    });

    Route::prefix('article')->controller(ArticleController::class)->group(function () {
        Route::get('/', 'manage')->name('admin.article.manage');
        Route::delete('/{id}', 'delete')->name('admin.article.delete');

        Route::get('/create', 'create_view')->name('admin.article.create_view');
        Route::post('/create', 'create_store')->name('admin.article.create_store');

        Route::get('/{id}/edit', 'edit_view')->name('admin.article.edit_view');
        Route::put('/{id}/edit', 'edit_store')->name('admin.article.edit_store');
        Route::put('/{id}/edit_id', 'edit_id')->name('admin.article.edit_id');

        Route::get('/{id}/add_lang', 'add_lang_view')->name('admin.article.add_lang_view');
        Route::post('/{id}/add_lang', 'add_lang_store')->name('admin.article.add_lang_store');

        Route::post('/add_tag', 'create_tag')->name('admin.article.add_tag');
        Route::put('/edit_tag/{id}', 'edit_tag')->name('admin.article.edit_tag');
        Route::delete('/delete_tag/{id}', 'delete_tag')->name('admin.article.delete_tag');
    });

    Route::prefix('review_home')->controller(ReviewHomeController::class)->group(function () {
        Route::get('/', 'manage')->name('admin.review_home.manage');
        Route::delete('/{id}', 'delete')->name('admin.review_home.delete');

        Route::get('/create', 'create_view')->name('admin.review_home.create_view');
        Route::post('/create', 'create_store')->name('admin.review_home.create_store');

        Route::get('/{id}/edit', 'edit_view')->name('admin.review_home.edit_view');
        Route::put('/{id}/edit', 'edit_store')->name('admin.review_home.edit_store');
        Route::put('/{id}/edit_id', 'edit_id')->name('admin.review_home.edit_id');

        Route::get('/{id}/add_lang', 'add_lang_view')->name('admin.review_home.add_lang_view');
        Route::post('/{id}/add_lang', 'add_lang_store')->name('admin.review_home.add_lang_store');

        Route::post('/add_project', 'create_project')->name('admin.review_home.add_project');
        Route::put('/edit_project/{id}', 'edit_project')->name('admin.review_home.edit_project');
        Route::delete('/delete_project/{id}', 'delete_project')->name('admin.review_home.delete_project');
    });

    Route::prefix('manage_faq')->controller(FaqController::class)->group(function () {
        Route::get('/', 'manage')->name('admin.faq.manage');
        Route::post('/', 'create_store')->name('admin.faq.create');
        Route::delete('/{id}', 'delete')->name('admin.faq.delete');
        Route::put('/{id}', 'edit_store')->name('admin.faq.edit');

        Route::post('/add_tag', 'create_tag')->name('admin.faq.add_tag');
        Route::put('/edit_tag/{id}', 'edit_tag')->name('admin.faq.edit_tag');
        Route::delete('/delete_tag/{id}', 'delete_tag')->name('admin.faq.delete_tag');
    });

    Route::prefix('employee')->controller(EmployeeController::class)->group(function () {
        Route::get('/', 'manage')->name('admin.employee.manage');
        Route::put('/{id}', 'edit')->name('admin.employee.edit');
        Route::delete('/{id}', 'delete')->name('admin.employee.delete');
        Route::post('/', 'create')->name('admin.employee.create');
    });

    Route::prefix('department')->controller(DepartmentController::class)->group(function () {
        Route::post('/', 'create')->name('admin.department.create');
        Route::put('/{id}', 'edit')->name('admin.department.edit');
        Route::delete('/{id}', 'delete')->name('admin.department.delete');
        Route::post('/reorder', 'reorder')->name('admin.department.reorder');
    });

    Route::prefix('major_department')->controller(DepartmentController::class)->group(function () {
        Route::get('/', 'major_manage')->name('admin.major_department.manage');
        Route::post('/', 'create_major')->name('admin.major_department.create');
        Route::put('/{id}', 'edit_major')->name('admin.major_department.edit');
        Route::delete('/{id}', 'delete_major')->name('admin.major_department.delete');
    });

    Route::prefix('privilege')->controller(PrivilegeController::class)->group(function () {
        Route::get('/', 'manage')->name('admin.privilege.manage');
        Route::delete('/{id}', 'delete')->name('admin.privilege.delete');

        Route::get('/create', 'create_view')->name('admin.privilege.create_view');
        Route::post('/create', 'create_store')->name('admin.privilege.create_store');

        Route::get('/{id}/edit', 'edit_view')->name('admin.privilege.edit_view');
        Route::put('/{id}/edit', 'edit_store')->name('admin.privilege.edit_store');
        Route::put('/{id}/edit_id', 'edit_id')->name('admin.privilege.edit_id');

        Route::get('/{id}/add_lang', 'add_lang_view')->name('admin.privilege.add_lang_view');
        Route::post('/{id}/add_lang', 'add_lang_store')->name('admin.privilege.add_lang_store');
    });

    Route::prefix('work')->controller(JobworkController::class)->group(function () {
        Route::get('/', 'manage')->name('admin.jobwork.manage');
        Route::post('/', 'create')->name('admin.jobwork.create');
        Route::delete('/{id}', 'delete')->name('admin.jobwork.delete');
        Route::put('/{id}', 'edit');
    });

    // Route::prefix('user')->controller(AdminController::class)->group(function () {
    //     Route::get('/', 'user_manage')->name('admin.user,manage');
    // });

    Route::post('/upload_image', [AdminController::class, 'upload_image'])->name('admin.upload');
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/houses', [HouseController::class, 'adminView'])->name('houses.index');
    Route::post('/houses', [HouseController::class, 'store'])->name('houses.store');
});

Route::prefix('api')->group(function () {
    Route::get('/houses', [HouseController::class, 'apiIndex']);
    Route::get('/houses/{id}', [HouseController::class, 'apiShow']);
});

Route::get('/compare-houses', function () {
    return view('admin.compare.compare_frontend');
});

Route::get('/admin/compare-house', [HouseController::class, 'adminView'])->name('admin.compare.compare_house');

Route::get('/admin/compare/compare_frontend', [HouseController::class, 'compareFrontend'])->name('admin.compare.compare_frontend');

Route::get('/admin/compare/comparison', [HouseController::class, 'comparisonView'])->name('admin.compare.comparison');

Route::prefix('api')->group(function () {
    Route::get('/houses', [HouseController::class, 'apiIndex']);
    Route::get('/houses/{id}', [HouseController::class, 'apiShow']);
    Route::prefix('faq')->controller(FaqController::class)->group(function () {
        Route::get('/faq_and_available_lang/{id}', 'get_faq_and_available_lang')->name('api.faq.get_faq_and_available_lang');
    });
});

Route::post('/contact/submit', [ContactController::class, 'store'])->name('contact.submit');

// Admin routes for managing contact messages
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/Mail/contact-messages', [ContactController::class, 'index'])->name('admin.contact.index');
    Route::get('/admin/Mail/contact-messages/{id}', [ContactController::class, 'show'])->name('admin.contact.show');
    Route::patch('/admin/Mail/contact-messages/{id}/status', [ContactController::class, 'updateStatus'])->name('admin.contact.update-status');
});


// Route::prefix('test')->controller(TestController::class)->group(function () {
//     Route::get('/create', 'create_article')->name('test.create_article');
//     Route::get('/create_tag', 'create_tag')->name('test.create_tag');
//     Route::get('/delete_tag', 'delete_tag')->name('test.delete_tag');
//     Route::get('/create_tag_article', 'create_tag_article')->name('test.create_tag_article');
// });


require __DIR__ . '/auth.php';
