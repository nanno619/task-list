<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('tasks.index'); // check ->name() that has 'tasks.index'
});

Route::get('/tasks', function () {
    return view('index', [
        // "tasks" => Task::latest()->get()
        "tasks" => Task::latest()->paginate(10) // Pagination
    ]);
})->name('tasks.index');

# TODO: Route to show form
Route::view('/tasks/create', 'create')->name('tasks.create');

# TODO: Route for creating Edit Form
# NOTE: Route Model Binding
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
      'task' => $task
    ]);
})->name('tasks.edit');

# NOTE: Route Model Binding
Route::get('/tasks/{task}', function (Task $task) {
    return view('show', [
      'task' => $task
    ]);
})->name('tasks.show');
 
# TODO: Store Form
# NOTE: We are going to submit the Form data to this route and this route will later on handle storing this new task
Route::post('/tasks', function (TaskRequest $request) {
    //dd($request->all());

    // Create new Task and insert into database
    // $data = $request->validated();
    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task = Task::create($request->validated());

    // 3. Redirect
    return redirect()->route('tasks.show', ['task' => $task->id])->with('success','Task created successfully');

})->name('tasks.store');

# TODO: Update Form
# NOTE: We are going to update the Form data to this route and this route will
# NOTE: later on handle updating this task
# NOTE: Route Model Binding
Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    //dd($request->all());

    // Update into database
    // $data = $request->validated();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task->update($request->validated());

    // 3. Redirect
    return redirect()->route('tasks.show', ['task' => $task->id])->with('success','Task updated successfully');

})->name('tasks.update');

# TODO: Delete Task
Route::delete('/tasks/{task}', function (Task $task){
    $task->delete();

    return redirect()->route('tasks.index')->with('success','Task deleted successfully');
})->name('tasks.destroy');

# TODO: Toggle Complete Task
Route::put('/tasks/{task}/toggle-complete', function (Task $task){
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task updated successfully');
})->name('tasks.toggle-complete');



// ** Route for creating Edit Form ** //
// Route::get('/tasks/{id}/edit', function ($id) {
//     return view('edit', [
//       'task' => Task::findOrFail($id)
//     ]);
// })->name('tasks.edit');

// Route::get('/tasks/{id}', function ($id) {
//     // collect() helper create a new collection instance from the array
//     // $task = collect($tasks)->firstWhere('id', $id); 
//     // The firstWhere method returns the first element in the collection with the given key / value pair

//     return view('show', [
//       'task' => Task::findOrFail($id)
//     ]);
// })->name('tasks.show');

// Route::put('/tasks/{id}', function ($id, Request $request) {
//     //dd($request->all());

//     // 1. Data validation
//     $data = $request->validate([
//         // 'form field name' => 'rules' 
//         'title' => 'required|max:255',
//         'description' => 'required',
//         'long_description' => 'required'
//     ]);

//     // 2. Find task with $id and update into database
//     $task = Task::findOrFail($id);
//     $task->title = $data['title'];
//     $task->description = $data['description'];
//     $task->long_description = $data['long_description'];
//     $task->save();

//     // 3. Redirect
//     return redirect()->route('tasks.show', ['id' => $task->id])->with('success','Task updated successfully');

// })->name('tasks.update');

// Route::get('/contact', function () {
//    return "This is contact page"; 
// });

// // Redirect Route
// Route::get('/hello', function () {
//     return redirect('/contact');
// });

// // Named route
// Route::get('/blog', function () {
//     return "This is blog page"; 
//  })->name('blog-list');

// Route::get('/about', function () {
//     return redirect()->route('blog-list'); //route('blog-list') refer to ->name();
// });

// //Route that not exist
// Route::fallback(function () {
//     return "You still somewhere!!";
// });

// Route::get('/greet/{name}', function ($name) {
//     return "Hello ". $name . "!";
// });


