<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Program;
use App\Models\ProgramLearningOutcome;


class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('program_learning_outcomes')->delete();

        $programU= new Program;
        $programU->program = 'Ministry of Advanced Education Standards - Undergraduate degrees';
        $programU->faculty = 'Other';
        $programU->department = 'Other';
        $programU->level = 'Undergraduate';
        $programU->status = 1;
        $programU->save();

        $programG= new Program;
        $programG->program = 'Ministry of Advanced Education Standards - Masters\'s degrees';
        $programG->faculty = 'Other';
        $programG->department = 'Other';
        $programG->level = 'Graduate';
        $programG->status = 1;
        $programG->save();

        $programD= new Program;
        $programD->program = 'Ministry of Advanced Education Standards - Doctoral degrees';
        $programD->faculty = 'Other';
        $programD->department = 'Other';
        $programD->level = 'Graduate';
        $programD->status = 1;
        $programD->save();

        $plos= [
            [
            'plo_shortphrase' => 'Depth and Breadth of Knowledge',
            'pl_outcome' =>'Basic understanding of the range of fields within the discipline/field. 
            Ability to gather, review, evaluate and interpret information, including new information relevant to the discipline.
            Capacity to engage in independent research or practice in a supervised context.
            Critical thinking/analytical skills.
            Ability to apply learning from one or more areas outside the discipline',
            'program_id' =>$programU->program_id,
                ],
            [
                'plo_shortphrase' => 'Knowledge of Methodologies and Research ',
                'pl_outcome' =>'Evaluate the appropriateness of different approaches to solving problems using well established ideas and techniques. 
                Devise and sustain arguments or solve problems using these methods. 
                Describe and comment upon particular aspects of current research or equivalent advanced scholarship in the discipline',
                'program_id' =>$programU->program_id,
                ],
            [
                'plo_shortphrase' => 'Communications Skills ',
                'pl_outcome' =>'Ability to communicate information, arguments, and analyses accurately and reliably, orally and in writing, to a range of audiences. 
                Use structured and coherent arguments',
                'program_id' =>$programU->program_id,
                ],
            [
                'plo_shortphrase' => 'Application of Knowledge  ',
                'pl_outcome' =>'Ability to review, present and critically evaluate qualitative and quantitative information to develop an argument, make sound judgement, apply concept, or use this knowledge in the creative process',
                'program_id' =>$programU->program_id,
                ],
            [
                'plo_shortphrase' => 'Awareness of Limits of Knowledge ',
                'pl_outcome' =>'Understanding of the limits to their own knowledge and ability. 
                Appreciation of the uncertainty, ambiguity and limits to knowledge and how this might influence analyses and interpretations',
                'program_id' =>$programU->program_id,
                ],
            [
                'plo_shortphrase' => 'Professional Capacity/Autonomy ',
                'pl_outcome' =>'Initiative, personal responsibility and accountability in both personal and group contexts. Working effectively with others. Behavior consistent with academic integrity ',
                'program_id' =>$programU->program_id,
                ],
            
            [
            'plo_shortphrase' => 'Depth and Breadth of Knowledge',
            'pl_outcome' =>'Systematic understanding of knowledge, and a critical awareness of current problems and/or new insights, much of which is at, or informed by, the forefront of their academic discipline, field of study, or area of professional practice e',
            'program_id' =>$programG->program_id,
                ],
            [
                'plo_shortphrase' => 'Knowledge of Methodologies and Research ',
                'pl_outcome' =>'Working comprehension of how established techniques of research and inquiry are used to create and interpret knowledge in the discipline.
                Capacity to evaluate critically current research and advanced research and scholarship in the discipline or area of professional competence.
                Capacity to address complex issues and judgments based on established principles and techniques. 
                Demonstrated ability to develop and support of a sustained argument in written form. Originality in the application of knowledge  ',
                'program_id' =>$programG->program_id,
                ],
            [
                'plo_shortphrase' => 'Communications Skills ',
                'pl_outcome' =>'Ability to communicate ideas, issues and conclusions clearly and effectively to specialist and non-specialist audiences.',
                'program_id' =>$programG->program_id,
                ],
            [
                'plo_shortphrase' => 'Application of Knowledge  ',
                'pl_outcome' =>'Competency in the research process by applying an existing body of knowledge in the research and critical analysis of a new question or of a specific problem or issue in a new setting ',
                'program_id' =>$programG->program_id,
                ],
            [
                'plo_shortphrase' => 'Awareness of Limits of Knowledge ',
                'pl_outcome' =>'Cognizance of the complexity of knowledge and of the potential contributions of other interpretations, methods, and disciplines. ',
                'program_id' =>$programG->program_id,
                ],
            [
                'plo_shortphrase' => 'Professional Capacity/Autonomy ',
                'pl_outcome' =>'Exercise of initiative and of personal responsibility and accountability. Decision-making in complex situations, such as employment. 
                Intellectual independence required for continuing professional development. Ability to appreciate the broader implications of applying knowledge to particular contexts',
                'program_id' =>$programG->program_id,
            ],

            [
                'plo_shortphrase' => 'Depth and Breadth of Knowledge',
                'pl_outcome' =>'Thorough understanding of a substantial body of knowledge that is at the forefront of their academic discipline or area of professional practice.',
                'program_id' =>$programD->program_id,
                    ],
                [
                    'plo_shortphrase' => 'Knowledge of Methodologies and Research ',
                    'pl_outcome' =>'Conceptualize, design, and implement research for the generation of new knowledge, applications, or understanding at the forefront of the discipline, and to adjust the research design or methodology in the light of unforeseen problems. 
                    Make informed judgments on complex issues in specialist fields, sometimes requiring new methods.Produce original research, or other advanced scholarship, of a quality to satisfy peer review, and to merit publication. ',
                    'program_id' =>$programD->program_id,
                    ],
                [
                    'plo_shortphrase' => 'Communications Skills ',
                    'pl_outcome' =>'Ability to communicate complex and/or ambiguous ideas, issues and conclusions clearly and effectively.',
                    'program_id' =>$programD->program_id,
                    ],
                [
                    'plo_shortphrase' => 'Application of Knowledge  ',
                    'pl_outcome' =>'Capacity to undertake pure and/or applied research at an advanced level. 
                    Capacity to contribute to the development of academic or professional skill, techniques, tools, practices, ideas, theories, approaches, and/or materials.  ',
                    'program_id' =>$programD->program_id,
                    ],
                [
                    'plo_shortphrase' => 'Awareness of Limits of Knowledge ',
                    'pl_outcome' =>'Appreciation of the limitations of one’s own work and discipline, of the complexity of knowledge, and of the potential contributions of other interpretations, methods, and disciplines. ',
                    'program_id' =>$programD->program_id,
                    ],
                [
                    'plo_shortphrase' => 'Professional Capacity/Autonomy ',
                    'pl_outcome' =>'Exercise of personal responsibility and largely autonomous initiative in complex situations. 
                    Intellectual independence to be academically and professionally engaged and current. 
                    Ability to evaluate the broader implications of applying knowledge to particular contexts. ',
                    'program_id' =>$programD->program_id,
                    ]
            
            
          ];



        DB::table('program_learning_outcomes')->insert($plos);
    }
}
