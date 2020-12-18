@extends('layouts.app')

@section('content')
    <!-- <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="jumbotron">
                <h1 class="display-4">UBCO Curriculum Alignment Tool</h1>
                <p class="lead">Course and program planning platform at UBCO</p>
                <hr class="my-4">
                <p>Plan, review and align courses and programs using online curriculum mapping tool. </p>
                 <p class="lead">
                    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
                </p>
             </div>
        </div>
    </div> -->

    <!-- <div class="row mb-5 mt-3 justify-content-center font-weight-bold text-primary">
        <div class="col-md-8">
            <h1><strong>What is Curriculum Mapping ?</strong></h1>
            <p>
                It is “the process of associating course outcomes with program‐level learning outcomes and aligning elements of courses 
                (e.g., teaching and learning activities, assessment strategies) within a program, to ensure that it is structured in a 
                strategic, thoughtful way that enhances student learning.” (Dyjur & Kalu, 2017). In other words, mapping provides a global view of how 
                elements of the curriculum relate to the program outcomes.
            </p>
           
        </div>
    </div> -->

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="jumbotron">
                <h1 class="display-4">Curriculum Alignment Tool (CAT)</h1>
                <p class="lead">This web application aims to support instructors to ideate, evaluate or create new programs and courses from a <a href="https://www.heacademy.ac.uk/sites/default/files/resources/id477_aligning_teaching_for_constructing_learning.pdf" target="_blank"><strong>constructive alignment</strong></a> perspective.</p>
                <!-- <hr class="my-4">
                <p>Plan, review and align courses and programs using online curriculum mapping tool. </p>
                 <p class="lead">
                    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
                </p> -->
             </div>
        </div>
    </div>



    <div class="row mb-5 mt-3 lead justify-content-center">
        <div class="col-md-10">
            <h1><strong>Curriculum Alignment Tool Overview</strong></h1>
            <p>
                The Curriculum Alignment Tool is a custom-built web application to support instructors with the;
            </p>
            <div class="card-deck">
                <div class="card">
                  <div class="card-body">
                    

                    <p class="card-text"><strong >IDEATION </strong>of a new program. It allows instructors to map program learning outcomes (PLOs) to course learning outcomes (CLOs) of required and non-required courses for the program. </p>
                    
                  </div>
                </div>
                <div class="card">
                  
                  <div class="card-body">
                    
    
                    <p class="card-text"><strong>EVALUATION</strong> of existing courses or programs by looking at the alignment across learning outcomes, assessment methods, and teaching and learning activities.</p>
                 
                  </div>
                </div>
                <div class="card">
                  
                  <div class="card-body">
                    
                    
                    <p class="card-text"><strong>CREATION</strong> of a new course by identifying course learning outcomes, assessment strategies, and teaching and learning methods</p>
                    
                  </div>
                </div>
              </div>
        </div>
    </div>

    <div class="row mb-5 mt-3 justify-content-center text-light">
        <div class="col-md-12 bg-primary">
            <div class="my-5">
               
               <div class="container">
                <div class="row">
                    <!-- <div class="col-md">
                        <h1>1. <p class="lead">Create a new program project</p></h1>
                        
                        <p>
                            Editor creates are new program project, inputs program learning outcomes, sets a mapping scale and assigns courses to other editors.
                        </p>

                    </div> -->
                    <div class="col-md font-weight-bold">
                        <h1><strong>How to use this Curriculum Alignment Tool ?</strong></h1>
                        
                        <p class="lead">
                            In order to use this tool, users must have identified the:
                        </p>

                        <ol>
                            <li class="lead" >Course/program learning outcomes</li>
                            <li class="lead" >Assessment methods (e.g. quizzes, oral presentation, research paper, etc.)</li>
                            <li class="lead" >Teaching and learning activities (e.g. lecture, problem-based learning, lab, tutorial, discussion, etc.)</li>
                        </ol>

                        <p class="lead">
                            Be ready to input this information when prompted by the application. The tool will walk you through a series of steps ending with a summary of your curriculum alignment.
                        </p>

                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5 mt-3 justify-content-center font-weight-bold">
        <div class="col-md-10">
            <h1><strong>Questions ?</strong></h1>
            <p class="lead">
                If you have questions about the Curriculum Alignment Tool, please contact <a href="mailto:laura.prada@ubc.ca">laura.prada@ubc.ca</a> at the <a href="https://provost.ok.ubc.ca/" target="_blank">Office of the Provost and Vice-President Academic, UBC Okanagan campus</a>.
            </p>
           
        </div>
    </div>
@endsection
