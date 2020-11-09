<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\MappingScale;

class MappingScaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $ms1 = new MappingScale;
        $ms1->title = "Introduced";
        $ms1->abbreviation = "I";
        $ms1->description = "Key ideas, concepts or skills related to the learning outcome are demonstrated at an introductory level. Learning activities focus on basic knowledge, skills, and/or competencies and entry-level complexity.";
        $ms1->colour = "#0065bd";
        $ms1->program_id = 1;
        $ms1->save();

        $ms2 = new MappingScale;
        $ms2->title = "Developing";
        $ms2->abbreviation = "D";
        $ms2->description = "Learning outcome is reinforced with feedback; students demonstrate the outcome at an increasing level of proficiency. Learning activities concentrate on enhancing and strengthening existing knowledge and skills as well as expanding complexity.";
        $ms2->colour = "#1aa7ff";
        $ms2->program_id = 1;
        $ms2->save();

        $ms3 = new MappingScale;
        $ms3->title = "Advanced";
        $ms3->abbreviation = "A";
        $ms3->description = "Students demonstrate the learning outcomes with a high level of independence, expertise and sophistication expected upon graduation. Learning activities focus on and integrate the use of content or skills in multiple.";
        $ms3->colour = "#80bdff";
        $ms3->program_id = 1;
        $ms3->save();

        /////////////////////////////////////////////////////////////

        $ms4 = new MappingScale;
        $ms4->title = "Introduced";
        $ms4->abbreviation = "I";
        $ms4->description = "Key ideas, concepts or skills related to the learning outcome are demonstrated at an introductory level. Learning activities focus on basic knowledge, skills, and/or competencies and entry-level complexity.";
        $ms4->colour = "#0065bd";
        $ms4->program_id = 2;
        $ms4->save();

        $ms5 = new MappingScale;
        $ms5->title = "Developing";
        $ms5->abbreviation = "D";
        $ms5->description = "Learning outcome is reinforced with feedback; students demonstrate the outcome at an increasing level of proficiency. Learning activities concentrate on enhancing and strengthening existing knowledge and skills as well as expanding complexity.";
        $ms5->colour = "#1aa7ff";
        $ms5->program_id = 2;
        $ms5->save();

        $ms6 = new MappingScale;
        $ms6->title = "Advanced";
        $ms6->abbreviation = "A";
        $ms6->description = "Students demonstrate the learning outcomes with a high level of independence, expertise and sophistication expected upon graduation. Learning activities focus on and integrate the use of content or skills in multiple.";
        $ms6->colour = "#80bdff";
        $ms6->program_id = 2;
        $ms6->save();

        /////////////////////////////////////////////////////////////

        $ms7 = new MappingScale;
        $ms7->title = "Introduced";
        $ms7->abbreviation = "I";
        $ms7->description = "Key ideas, concepts or skills related to the learning outcome are demonstrated at an introductory level. Learning activities focus on basic knowledge, skills, and/or competencies and entry-level complexity.";
        $ms7->colour = "#0065bd";
        $ms7->program_id = 3;
        $ms7->save();

        $ms8 = new MappingScale;
        $ms8->title = "Developing";
        $ms8->abbreviation = "D";
        $ms8->description = "Learning outcome is reinforced with feedback; students demonstrate the outcome at an increasing level of proficiency. Learning activities concentrate on enhancing and strengthening existing knowledge and skills as well as expanding complexity.";
        $ms8->colour = "#1aa7ff";
        $ms8->program_id = 3;
        $ms8->save();

        $ms9 = new MappingScale;
        $ms9->title = "Advanced";
        $ms9->abbreviation = "A";
        $ms9->description = "Students demonstrate the learning outcomes with a high level of independence, expertise and sophistication expected upon graduation. Learning activities focus on and integrate the use of content or skills in multiple.";
        $ms9->colour = "#80bdff";
        $ms9->program_id = 3;
        $ms9->save();

    }
}