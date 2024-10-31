<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\EventController;
use App\Http\Controllers\Front\NewsController;
use App\Http\Controllers\Front\BlogTeacherController;
use App\Http\Controllers\Front\ExtracurricularController;
use App\Http\Controllers\Front\AchievementController;
use App\Http\Controllers\Front\GalleryController;
use App\Http\Controllers\Front\ProfilMenu;
use App\Http\Controllers\Front\PersonaliaMenu;

use App\Http\Controllers\Back\DashboardController as BackDashboardController;
use App\Http\Controllers\Back\EventController as BackEventController;
use App\Http\Controllers\Back\NewsController as BackNewsController;
use App\Http\Controllers\Back\BlogTeacherController as BackBlogTeacherController;
use App\Http\Controllers\Back\SekapurSirihController as BackSekapurSirihController;
use App\Http\Controllers\Back\AchievementController as BackAchievementController;
use App\Http\Controllers\Back\GalleryController as BackGalleryController;
use App\Http\Controllers\Back\CalendarController as BackCalendarController;
use App\Http\Controllers\Back\SchoolYearController as BackSchoolYearController;
use App\Http\Controllers\Back\ClassroomController as BackClassroomController;
use App\Http\Controllers\Back\ExtracurricularController as BackExtracurricularController;
use App\Http\Controllers\Back\PartnerLinkController as BackPartnerLinkController;
use App\Http\Controllers\Back\UserController as BackUserController;
use App\Http\Controllers\Back\MenuPersonaliaController as BackMenuPersonaliaController;
use App\Http\Controllers\Back\MenuProfilController as BackMenuProfilController;
use App\Http\Controllers\Back\SettingController as BackSettingController;
use App\Http\Controllers\Back\DisciplineRulesController as BackDisciplineRulesController;
use App\Http\Controllers\Back\DisciplineStudentController as BackDisciplineStudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sekapur-sirih', [HomeController::class, 'sekapurSirih'])->name('sekapur_sirih');
Route::get('/calendar', [HomeController::class, 'calendar'])->name('calendar');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/forgot-password', [AuthController::class, 'forgotPasswordProcess'])->name('forgot.password.process');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('reset.password');
Route::post('/reset-password/{token}', [AuthController::class, 'resetPasswordProcess'])->name('reset.password.process');

Route::get('/tenaga-pendidik', [PersonaliaMenu::class, 'teacher'])->name('teacher');
Route::get('/tenaga-kependidikan', [PersonaliaMenu::class, 'staff'])->name('staff');
Route::get('/staff/{id}', [PersonaliaMenu::class, 'staffDetail'])->name('staff.detail');
Route::get('/personalia/{slug}', [PersonaliaMenu::class, 'personalia'])->name('personalia.show');

Route::get('/profil/{slug}', [ProfilMenu::class, 'index'])->name('profil.show');

// Route::get('/ekstrakurikuler', [ExtracurricularController::class, 'index'])->name('extracurricular');
Route::get('/ekstrakurikuler/{slug}', [ExtracurricularController::class, 'show'])->name('extracurricular.show');

// Route::get('/gallery', [GalleryController::class, 'album'])->name('gallery');
Route::get('/gallery/{slug}', [GalleryController::class, 'show'])->name('gallery.show');

Route::prefix('event')->name('event.')->group(function () {
    // Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('/{slug}', [EventController::class, 'show'])->name('show');
});

Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    route::get('/category/{slug}', [NewsController::class, 'category'])->name('category');
    Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
    Route::post('/{slug}', [NewsController::class, 'comment'])->name('comment');
});

Route::prefix('blog-teacher')->name('blog_teacher.')->group(function () {
    Route::get('/', [BlogTeacherController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogTeacherController::class, 'show'])->name('show');
    Route::post('/{slug}', [BlogTeacherController::class, 'comment'])->name('comment');
});

Route::prefix('achievement')->name('achievement.')->group(function () {
    Route::get('/student', [AchievementController::class, 'student'])->name('student');
    Route::get('/teacher', [AchievementController::class, 'teacher'])->name('teacher');
    Route::get('/student/{id}', [AchievementController::class, 'studentDetail'])->name('student.detail');
    Route::get('/teacher/{id}', [AchievementController::class, 'teacherDetail'])->name('teacher.detail');
});




Route::prefix('back')->middleware('auth')->name('back.')->group(function () {
    Route::get('/dashboard', [BackDashboardController::class, 'index'])->name('dashboard');

    Route::prefix('event')->name('event.')->group(function () {
        Route::get('/', [BackEventController::class, 'index'])->name('index');
        Route::get('/create', [BackEventController::class, 'create'])->name('create');
        Route::post('/create', [BackEventController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BackEventController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [BackEventController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BackEventController::class, 'destroy'])->name('destroy');
    });


    Route::prefix('news')->name('news.')->group(function () {
        Route::get('/category', [BackNewsController::class, 'category'])->name('category');
        Route::post('/category', [BackNewsController::class, 'categoryStore'])->name('category.store');
        Route::put('/category/edit/{id}', [BackNewsController::class, 'categoryUpdate'])->name('category.update');
        Route::delete('/category/delete/{id}', [BackNewsController::class, 'categoryDestroy'])->name('category.destroy');

        Route::get('/', [BackNewsController::class, 'index'])->name('index');
        Route::get('/create', [BackNewsController::class, 'create'])->name('create');
        Route::post('/create', [BackNewsController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BackNewsController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [BackNewsController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BackNewsController::class, 'destroy'])->name('destroy');

        Route::get('/comment', [BackNewsController::class, 'comment'])->name('comment');
        Route::post('/comment/spam/{id}', [BackNewsController::class, 'commentSpam'])->name('comment.spam');
    });

    Route::prefix('blog-teacher')->name('blog_teacher.')->group(function () {
        Route::get('/', [BackBlogTeacherController::class, 'index'])->name('index');
        Route::get('/create', [BackBlogTeacherController::class, 'create'])->name('create');
        Route::post('/create', [BackBlogTeacherController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BackBlogTeacherController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [BackBlogTeacherController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BackBlogTeacherController::class, 'destroy'])->name('destroy');

        Route::get('/comment', [BackBlogTeacherController::class, 'comment'])->name('comment');
        Route::post('/comment/spam/{id}', [BackBlogTeacherController::class, 'commentSpam'])->name('comment.spam');
    });

    Route::prefix('gallery')->name('gallery.')->group(function () {
        Route::get('/album', [BackGalleryController::class, 'album'])->name('album');
        Route::post('/album', [BackGalleryController::class, 'albumStore'])->name('album.store');
        Route::put('/album/{id}', [BackGalleryController::class, 'albumUpdate'])->name('album.update');
        Route::delete('/album/{id}', [BackGalleryController::class, 'albumDestroy'])->name('album.destroy');

        Route::get('/', [BackGalleryController::class, 'index'])->name('index');
        Route::post('/create', [BackGalleryController::class, 'store'])->name('store');
        Route::put('/edit/{id}', [BackGalleryController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BackGalleryController::class, 'destroy'])->name('destroy');
    });

    Route::get('/sekapur-sirih', [BackSekapurSirihController::class, 'index'])->name('sekapur_sirih');
    Route::put('/sekapur-sirih', [BackSekapurSirihController::class, 'update'])->name('sekapur_sirih.update');

    Route::prefix('achievement')->name('achievement.')->group(function () {
        Route::prefix('student')->name('student.')->group(function () {
            Route::get('/', [BackAchievementController::class, 'studentAchievement'])->name('index');
            Route::get('/create', [BackAchievementController::class, 'studentAchievementCreate'])->name('create');
            Route::post('/create', [BackAchievementController::class, 'studentAchievementStore'])->name('store');
            Route::get('/edit/{id}', [BackAchievementController::class, 'studentAchievementEdit'])->name('edit');
            Route::put('/edit/{id}', [BackAchievementController::class, 'studentAchievementUpdate'])->name('update');
            Route::delete('/delete/{id}', [BackAchievementController::class, 'studentAchievementDestroy'])->name('destroy');
        });

        Route::prefix('teacher')->name('teacher.')->group(function () {
            Route::get('/', [BackAchievementController::class, 'teacherAchievement'])->name('index');
            Route::get('/create', [BackAchievementController::class, 'teacherAchievementCreate'])->name('create');
            Route::post('/create', [BackAchievementController::class, 'teacherAchievementStore'])->name('store');
            Route::get('/edit/{id}', [BackAchievementController::class, 'teacherAchievementEdit'])->name('edit');
            Route::put('/edit/{id}', [BackAchievementController::class, 'teacherAchievementUpdate'])->name('update');
            Route::delete('/delete/{id}', [BackAchievementController::class, 'teacherAchievementDestroy'])->name('destroy');
        });
    });

    Route::prefix('calendar')->name('calendar.')->group(function () {
        Route::get('/', [BackCalendarController::class, 'index'])->name('index');
        Route::post('/create', [BackCalendarController::class, 'store'])->name('store');
        Route::put('/edit', [BackCalendarController::class, 'update'])->name('update');
        Route::delete('/delete', [BackCalendarController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('school-year')->name('school-year.')->group(function () {
        Route::get('/', [BackSchoolYearController::class, 'index'])->name('index');
        Route::post('/create', [BackSchoolYearController::class, 'store'])->name('store');
        Route::put('/edit/{id}', [BackSchoolYearController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BackSchoolYearController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('classroom')->name('classroom.')->group(function () {
        Route::get('/', [BackClassroomController::class, 'index'])->name('index');
        Route::post('/create', [BackClassroomController::class, 'store'])->name('store');
        Route::put('/edit/{id}', [BackClassroomController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BackClassroomController::class, 'destroy'])->name('destroy');

        Route::get('/detail/{id}', [BackClassroomController::class, 'detail'])->name('detail');
        Route::post('/detail/{id}/add-student', [BackClassroomController::class, 'addStudent'])->name('add.student.store');
        Route::delete('/detail/{id}/delete-student/{student_id}', [BackClassroomController::class, 'removeStudent'])->name('delete.student.destroy');

        Route::get('/detail/{id}/export', [BackClassroomController::class, 'export'])->name('export');

    });


    Route::prefix('user')->name('user.')->group(function () {
        Route::prefix('staff')->name('staff.')->group(function () {
            Route::get('/', [BackUserController::class, 'staff'])->name('index');
            Route::get('/create', [BackUserController::class, 'staffCreate'])->name('create');
            Route::post('/create', [BackUserController::class, 'staffStore'])->name('store');
            Route::get('/edit/{id}', [BackUserController::class, 'staffEdit'])->name('edit');
            Route::put('/edit/{id}', [BackUserController::class, 'staffUpdate'])->name('update');
            Route::delete('/delete/{id}', [BackUserController::class, 'staffDestroy'])->name('destroy');
        });

        Route::prefix('student')->name('student.')->group(function () {
            Route::get('/', [BackUserController::class, 'student'])->name('index');
            Route::get('/create', [BackUserController::class, 'studentCreate'])->name('create');
            Route::post('/create', [BackUserController::class, 'studentStore'])->name('store');
            Route::get('/edit/{id}', [BackUserController::class, 'studentEdit'])->name('edit');
            Route::put('/edit/{id}', [BackUserController::class, 'studentUpdate'])->name('update');
            Route::delete('/delete/{id}', [BackUserController::class, 'studentDestroy'])->name('destroy');

            Route::post('/import', [BackUserController::class, 'studentImport'])->name('import');
            Route::get('/export', [BackUserController::class, 'studentExport'])->name('export');

        });

        Route::prefix('parent')->name('parent.')->group(function () {
            Route::get('/', [BackUserController::class, 'parent'])->name('index');
            Route::get('/create', [BackUserController::class, 'parentCreate'])->name('create');
            Route::post('/create', [BackUserController::class, 'parentStore'])->name('store');
            Route::get('/edit/{id}', [BackUserController::class, 'parentEdit'])->name('edit');
            Route::put('/edit/{id}', [BackUserController::class, 'parentUpdate'])->name('update');
            Route::delete('/delete/{id}', [BackUserController::class, 'parentDestroy'])->name('destroy');
        });
    });

    Route::prefix('extracurricular')->name('extracurricular.')->group(function () {
        Route::get('/', [BackExtracurricularController::class, 'index'])->name('index');
        Route::post('/create', [BackExtracurricularController::class, 'store'])->name('store');
        Route::put('/edit/{id}', [BackExtracurricularController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BackExtracurricularController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('partner-link')->name('partner-link.')->group(function () {
        Route::get('/', [BackPartnerLinkController::class, 'index'])->name('index');
        Route::post('/create', [BackPartnerLinkController::class, 'store'])->name('store');
        Route::put('/edit/{id}', [BackPartnerLinkController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BackPartnerLinkController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('menu')->name('menu.')->group(function () {
        Route::prefix('personalia')->name('personalia.')->group(function () {
            Route::get('/', [BackMenuPersonaliaController::class, 'index'])->name('index');
            Route::post('/create', [BackMenuPersonaliaController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [BackMenuPersonaliaController::class, 'edit'])->name('edit');
            Route::put('/edit/{id}', [BackMenuPersonaliaController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [BackMenuPersonaliaController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('profil')->name('profil.')->group(function () {
            Route::get('/', [BackMenuProfilController::class, 'index'])->name('index');
            Route::post('/create', [BackMenuProfilController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [BackMenuProfilController::class, 'edit'])->name('edit');
            Route::put('/edit/{id}', [BackMenuProfilController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [BackMenuProfilController::class, 'destroy'])->name('destroy');
        });

    });


    Route::prefix('setting')->name('setting.')->group(function () {
        Route::get('/website', [BackSettingController::class, 'website'])->name('website');
        Route::put('/website', [BackSettingController::class, 'websiteUpdate'])->name('website.update');
        Route::put('/website/info', [BackSettingController::class, 'informationUpdate'])->name('website.info');

        Route::get('/banner', [BackSettingController::class, 'banner'])->name('banner');
        Route::post('/banner', [BackSettingController::class, 'bannerCreate'])->name('banner.create');
        Route::put('/banner/{id}', [BackSettingController::class, 'bannerUpdate'])->name('banner.update');
        Route::get('/banner/{id}', [BackSettingController::class, 'bannerDestroy'])->name('banner.destroy');
    });

    Route::prefix('discipline')->name('discipline.')->group(function () {
        Route::prefix('rule')->name('rule.')->group(function () {
            Route::get('/', [BackDisciplineRulesController::class, 'index'])->name('index');
            Route::post('/create', [BackDisciplineRulesController::class, 'store'])->name('store');
            Route::put('/edit/{id}', [BackDisciplineRulesController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [BackDisciplineRulesController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('student')->name('student.')->group(function () {
            Route::get('/', [BackDisciplineStudentController::class, 'index'])->name('index');
            Route::get('/create', [BackDisciplineStudentController::class, 'create'])->name('create');
            Route::post('/create', [BackDisciplineStudentController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [BackDisciplineStudentController::class, 'edit'])->name('edit');
            Route::put('/edit/{id}', [BackDisciplineStudentController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [BackDisciplineStudentController::class, 'destroy'])->name('destroy');

            Route::get('/apiStudent', [BackDisciplineStudentController::class, 'apiStudent'])->name('apiStudent');
        });
    });
});
