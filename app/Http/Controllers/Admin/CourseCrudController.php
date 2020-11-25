<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourseRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use App\Models\Course;

/**
 * Class CourseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CourseCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Course::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/course');
        CRUD::setEntityNameStrings('course', 'courses');

        //$this->crud->denyAccess('create');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        
        $this->crud->addColumn([
            'name' => 'course_code', // The db column name
            'label' => "Course Code", // Table column heading
            'type' => 'Text'
          ]);

        $this->crud->addColumn([
            'name' => 'course_num', // The db column name
            'label' => "Course Number", // Table column heading
            'type' => 'number'
          ]);
        
        $this->crud->addColumn([
            'name' => 'course_title', // The db column name
            'label' => "Course Title", // Table column heading
            'type' => 'Text'
          ]);

        $this->crud->addColumn([
            // 1-n relationship
            'label'     => 'Program', // Table column heading
            'type'      => 'select',
            'name'      => 'program_id', // the column that contains the ID of that connected entity;
            'entity'    => 'program', // the method that defines the relationship in your Model
            'attribute' => 'program', // foreign key attribute that is shown to user
            'model'     => "App\Models\Program", // foreign key model
          ]);

        $this->crud->addColumn([   // radio
            'name'        => 'status', // the name of the db column
            'label'       => 'Status', // the input label
            'type'        => 'radio',
            'options'     => [
                // the key will be stored in the db, the value will be shown as label; 
                -1 => "❗In Progress",
                1 => "✔️Completed"
            ],
            // optional
            //'inline'      => false, // show the radios all on the same line?
        ]);

        $this->crud->addColumn([
            'name'      => 'row_number',
            'type'      => 'row_number',
            'label'     => '#',
            'orderable' => false,
        ])->makeFirstColumn();
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CourseRequest::class);

        $this->crud->addField([
            'name' => 'course_code', // The db column name
            'label' => "Course Code", // Table column heading
            'type' => 'Text'
         ]);

        $this->crud->addField([
            'name' => 'course_num', // The db column name
            'label' => "Course Number", // Table column heading
            'type' => 'number'
          ]);
        
        $this->crud->addField([
            'name' => 'course_title', // The db column name
            'label' => "Course Title", // Table column heading
            'type' => 'Text'
          ]);

        $this->crud->addField([
            // 1-n relationship
            'label'     => 'Program', // Table column heading
            'type'      => 'select',
            'name'      => 'program_id', // the column that contains the ID of that connected entity;
            'entity'    => 'program', // the method that defines the relationship in your Model
            'attribute' => 'program', // foreign key attribute that is shown to user
            'model'     => "App\Models\Program", // foreign key model

          ]);

        
        $this->crud->addField([   // radio
            'name'        => 'status', // the name of the db column
            'label'       => 'Status', // the input label
            'type'        => 'radio',
            'options'     => [
                // the key will be stored in the db, the value will be shown as label; 
                -1 => "In Progress",
                1 => "Completed"
            ],
            // optional
            //'inline'      => false, // show the radios all on the same line?
        ]);

        $this->crud->addField([   // Hidden
            'name'  => 'type',
            'type'  => 'hidden',
            'value' => 'assigned',
        ]);

        $this->crud->addField([   // relationship
            'label' => "Assigned Instructors",
            'type' => "select2_multiple",
            'name' => 'users', // the method on your model that defines the relationship

            // OPTIONALS:
            'entity' => 'users', // the method that defines the relationship in your Model
            'attribute' => "email", // foreign key attribute that is shown to user (identifiable attribute)
            'model' => "App\Models\User", // foreign key Eloquent model
            'placeholder' => "Select a user", // placeholder for the select2 input
            'pivot'     => true,
            'select_all' => true,

         ]);

        $this->crud->addField([   // radio
            'name'        => 'assigned', // the name of the db column
            'label'       => 'Assigned to instructor', // the input label
            'type'        => 'radio',
            'options'     => [
                // the key will be stored in the db, the value will be shown as label; 
                -1 => "No",
                1 => "Yes"
            ],
            // optional
            //'inline'      => false, // show the radios all on the same line?
        ]);

        $this->crud->addField([   // CustomHTML
            'name'  => 'helper',
            'type'  => 'custom_html',
            'value' => '<small class="form-text text-muted">If instructors have been assigned to this course please select yes else select no</small>'
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
       // $this->setupCreateOperation();

        $this->crud->addField([
            'name' => 'course_code', // The db column name
            'label' => "Course Code", // Table column heading
            'type' => 'Text'
         ]);

        $this->crud->addField([
            'name' => 'course_num', // The db column name
            'label' => "Course Number", // Table column heading
            'type' => 'number'
          ]);
        
        $this->crud->addField([
            'name' => 'course_title', // The db column name
            'label' => "Course Title", // Table column heading
            'type' => 'Text'
          ]);

        $this->crud->addField([
            // 1-n relationship
            'label'     => 'Program', // Table column heading
            'type'      => 'select',
            'name'      => 'program_id', // the column that contains the ID of that connected entity;
            'entity'    => 'program', // the method that defines the relationship in your Model
            'attribute' => 'program', // foreign key attribute that is shown to user
            'model'     => "App\Models\Program", // foreign key model

          ]);

        
        $this->crud->addField([   // radio
            'name'        => 'status', // the name of the db column
            'label'       => 'Status', // the input label
            'type'        => 'radio',
            'options'     => [
                // the key will be stored in the db, the value will be shown as label; 
                -1 => "In Progress",
                1 => "Completed"
            ],
            // optional
            //'inline'      => false, // show the radios all on the same line?
        ]);

        
        $this->crud->addField([   // relationship
            'label' => "Assigned Instructors",

            'type' => "select2_multiple",

            'name' => 'users', // the method on your model that defines the relationship

            // OPTIONALS:
            
            'entity' => 'users', // the method that defines the relationship in your Model
        
            'attribute' => "email", // foreign key attribute that is shown to user (identifiable attribute)

            'model' => "App\Models\User", // foreign key Eloquent model

            'placeholder' => "Select a user", // placeholder for the select2 input

            'pivot'     => true,

            'select_all' => true,

         ]);

         $this->crud->addField([   // radio
            'name'        => 'assigned', // the name of the db column
            'label'       => 'Assigned to instructor', // the input label
            'type'        => 'radio',
            'options'     => [
                // the key will be stored in the db, the value will be shown as label; 
                -1 => "No",
                1 => "Yes"
            ],
            // optional
            //'inline'      => false, // show the radios all on the same line?
        ]);

        $this->crud->addField([   // CustomHTML
            'name'  => 'helper',
            'type'  => 'custom_html',
            'value' => '<small class="form-text text-muted">If instructors have been assigned to this course please select yes else select no</small>'
        ]);
        
        //  $this->crud->addField([   // relationship
        //     'label' => "Course Learning Outcomes",

        //     'type' => "select2_multiple",

        //     'name' => 'learningOutcomes', // the method on your model that defines the relationship

        //     // OPTIONALS:
            
        //     'entity' => 'learningOutcomes', // the method that defines the relationship in your Model
        
        //     'attribute' => "l_outcome", // foreign key attribute that is shown to user (identifiable attribute)

        //     'model' => "App\Models\LearningOutcome", // foreign key Eloquent model

        //     'placeholder' => "Select a learning outcome", // placeholder for the select2 input

        //     'pivot'     => true,

        //     'select_all' => true,

        //  ]);

        //  $this->crud->addField([   // relationship
        //     'label' => "Assessment Methods",

        //     'type' => "select2_multiple",

        //     'name' => 'assessmentMethods', // the method on your model that defines the relationship

        //     // OPTIONALS:
            
        //     'entity' => 'assessmentMethods', // the method that defines the relationship in your Model
        
        //     'attribute' => "a_method", // foreign key attribute that is shown to user (identifiable attribute)

        //     'model' => "App\Models\AssessmentMethod", // foreign key Eloquent model

        //     'placeholder' => "Select an assessment method", // placeholder for the select2 input

        //     'pivot'     => true,

        //     'select_all' => true,

        //  ]);

        //  $this->crud->addField([   // relationship
        //     'label' => "Teaching and Learning Activities",

        //     'type' => "select2_multiple",

        //     'name' => 'learningActivities', // the method on your model that defines the relationship

        //     // OPTIONALS:
            
        //     'entity' => 'learningActivities', // the method that defines the relationship in your Model
        
        //     'attribute' => "l_activity", // foreign key attribute that is shown to user (identifiable attribute)

        //     'model' => "App\Models\LearningActivity", // foreign key Eloquent model

        //     'placeholder' => "Select a learning activity", // placeholder for the select2 input

        //     'pivot'     => true,

        //     'select_all' => true,

        //  ]);

    }

    protected function setupShowOperation()
    {
        //CRUD::setValidation(CourseRequest::class);
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumn([
            'name' => 'course_code', // The db column name
            'label' => "Course Code", // Table column heading
            'type' => 'Text'
          ]);

        $this->crud->addColumn([
            'name' => 'course_num', // The db column name
            'label' => "Course Number", // Table column heading
            'type' => 'number'
          ]);
        
        $this->crud->addColumn([
            'name' => 'course_title', // The db column name
            'label' => "Course Title", // Table column heading
            'type' => 'Text'
          ]);

        $this->crud->addColumn([
            // 1-n relationship
            'label'     => 'Program', // Table column heading
            'type'      => 'select',
            'name'      => 'program_id', // the column that contains the ID of that connected entity;
            'entity'    => 'program', // the method that defines the relationship in your Model
            'attribute' => 'program', // foreign key attribute that is shown to user
            'model'     => App\Models\Program::class, // foreign key model
          ]);
        
        $this->crud->addColumn([   // radio
            'name'        => 'status', // the name of the db column
            'label'       => 'Status', // the input label
            'type'        => 'radio',
            'options'     => [
                // the key will be stored in the db, the value will be shown as label; 
                -1 => "In Progress",
                1 => "Completed"
            ],
            // optional
            //'inline'      => false, // show the radios all on the same line?
        ]);

        $this->crud->addColumn([   // radio
            'name'        => 'assigned', // the name of the db column
            'label'       => 'Assigned to instructor', // the input label
            'type'        => 'radio',
            'options'     => [
                // the key will be stored in the db, the value will be shown as label; 
                -1 => "No",
                1 => "Yes"
            ],
            // optional
            //'inline'      => false, // show the radios all on the same line?
        ]);
        
        $this->crud->addColumn([  
            // any type of relationship
            'name'         => 'users', // name of relationship method in the model
            'type'         => 'select_multiple',
            'label'        => 'Assigned Instructors', // Table column heading
            // OPTIONAL
            'entity'       => 'users', // the method that defines the relationship in your Model
            'attribute'    => 'email', // foreign key attribute that is shown to user
            'model'        => App\Models\User::class, // foreign key model
         ]);

        // $this->crud->addColumn([  
        //     // any type of relationship
        //     'name'         => 'learningOutcomes', // name of relationship method in the model
        //     'type'         => 'relationship',
        //     'label'        => 'Learning Outcomes', // Table column heading
        //     // OPTIONAL
        //     'entity'       => 'learningOutcomes', // the method that defines the relationship in your Model
        //     'attribute'    => 'l_outcome', // foreign key attribute that is shown to user
        //     'model'        => App\Models\LearningOutcome::class, // foreign key model
        //  ]);

        // $this->crud->addColumn([  
        //     // any type of relationship
        //     'name'         => 'learningActivities', // name of relationship method in the model
        //     'type'         => 'relationship',
        //     'label'        => 'Learning Activities', // Table column heading
        //     // OPTIONAL
        //     'entity'       => 'learningActivities', // the method that defines the relationship in your Model
        //     'attribute'    => 'l_activity', // foreign key attribute that is shown to user
        //     'model'        => App\Models\LearningActivity::class, // foreign key model
        //  ]);
        
        // $this->crud->addColumn([  
        //     // any type of relationship
        //     'name'         => 'assessmentMethods', // name of relationship method in the model
        //     'type'         => 'relationship',
        //     'label'        => 'Assessment Methods', // Table column heading
        //     // OPTIONAL
        //     'entity'       => 'assessmentMethods', // the method that defines the relationship in your Model
        //     'attribute'    => 'a_method', // foreign key attribute that is shown to user
        //     'model'        => App\Models\AssessmentMethod::class, // foreign key model
        //  ]);

        

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }
}
