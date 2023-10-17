<?php

use Illuminate\Http\Request;
use Modules\Evaluation\Http\Controllers\EvaluationController;
use Modules\Evaluation\Http\Controllers\EvaluationHeaderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => 'evaluationheaders'], function () {
        Route::get('/', [EvaluationHeaderController::class, 'index'])->name('evaluationheaders.index');
        Route::post('/create', [EvaluationHeaderController::class, 'store'])->name('evaluationheaders.create');
        Route::get('/{header}', [EvaluationHeaderController::class, 'show'])->name('evaluationheaders.show');
        Route::post('/{header}/update', [EvaluationHeaderController::class, 'update'])->name('evaluationheaders.update');
        Route::delete('/{header}/delete', [EvaluationHeaderController::class, 'destroy'])->name('evaluationheaders.delete');

    });

    Route::group(['prefix' => 'evaluations'], function () {
        Route::get('/', [EvaluationController::class, 'index'])->name('evaluations.index');
        Route::post('/create', [EvaluationController::class, 'store'])->name('evaluations.create');
        Route::get('/{evaluation}', [EvaluationController::class, 'show'])->name('evaluations.show');
        Route::get('/{evaluation}/show', [EvaluationController::class, 'EvaluationShow'])->name('evaluations.showAllEvaluation');
        Route::post('/{evaluation}/update', [EvaluationController::class, 'update'])->name('evaluations.update');
        Route::post('/{evaluation}/submit', [EvaluationController::class, 'submitEvaluation'])->name('evaluations.submit');
        Route::delete('/{evaluation}/delete', [EvaluationController::class, 'destroy'])->name('evaluations.delete');
        Route::get('/{child}/{sideProfile}/{evaluation}/result', [EvaluationController::class, 'showResultExamForChildren'])->name('evaluation.result');
        Route::post('/{child}/{sideProfile}/{evaluation}/result', [EvaluationController::class, 'showResultExamForChildrenWithDate'])->name('evaluation.resultFilter');
        Route::post('/{evaluation}/{evaluationHeader}/basalAge', [EvaluationController::class, 'basalAge'])->name('evaluation.basalAge');
        Route::get('/{child}/{sideProfile}/evaluations-child', [EvaluationController::class, 'showEvaluationsForChildWithSpecificSideProfile'])->name('evaluation.showEvaluationsForChildWithSpecificSideProfile');
        Route::post('/{evaluationResults}',[EvaluationController::class,'editDateEvaluations'])->name('evaluationResult.edit');
    });


    Route::group(['prefix' => 'side-profiles'], function () {
        Route::get('/', [\Modules\Evaluation\Http\Controllers\SideProfileController::class, 'index'])->name('sideProfile.index');
        Route::get('/all-evaluations', [\Modules\Evaluation\Http\Controllers\SideProfileController::class, 'getSideprofileWithEvalautions']);
        Route::post('/create', [\Modules\Evaluation\Http\Controllers\SideProfileController::class, 'store'])->name('sideProfile.create');
        Route::get('/{sideProfile}/evaluations', [\Modules\Evaluation\Http\Controllers\SideProfileController::class, 'getAllEvaluation'])->name('sideProfile.evaluations');
        Route::get('/{sideProfile}', [\Modules\Evaluation\Http\Controllers\SideProfileController::class, 'show'])->name('sideProfile.show');
        Route::post('/{sideProfile}/update', [\Modules\Evaluation\Http\Controllers\SideProfileController::class, 'update'])->name('sideProfile.update');
        Route::delete('/{sideProfile}/delete', [\Modules\Evaluation\Http\Controllers\SideProfileController::class, 'destroy'])->name('sideProfile.delete');
    });
});

