<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('programs')->delete();

        $programs = [
            [
            'program' => 'Anthropology' ,
            'faculty' =>'Arts and Social Sciences' ,
            'level' =>'Undergraduate' ,
        ],[
            'program' => 'Applied Science',
            'faculty' => 'Applied Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Art History and Visual Culture - Combined Major with Art History and Visual Culture',
            'faculty' => 'Creative and Critical Studies' ,
            'level' => 'Undergraduate',
        ],[
            'program' => 'Art History and Visual Culture',
            'faculty' => 'Creative and Critical Studies' ,
            'level' => 'Undergraduate',
        ],[
            'program' => 'Biochemistry and Molecular Biology',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Biochemistry and Molecular Biology',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Biology',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Biology',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Chemistry',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Chemistry',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Civil Engineering',
            'faculty' => 'Applied Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Computer Science (B.A.)',
            'faculty' => 'Arts and Social Sciences',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Computer Science (B.Sc.)',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Computer Science (M.Sc.)',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Computer Science (Ph.D.)',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Creative Writing',
            'faculty' => 'Creative and Critical Studies',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Creative Writing - Combined Major with Creative Writing',
            'faculty' => 'Creative and Critical Studies ',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Cultural Studies',
            'faculty' => 'Creative and Critical Studies',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Cultural Studies - Combined Major with Creative Writing',
            'faculty' => 'Creative and Critical Studies',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Data Science',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Data Science',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Developmental Standard Teaching Certificate in Okanagan Language and Culture' ,
            'faculty' => 'Education',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Earth and Environmental Sciences',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Earth and Environmental Sciences',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Ecology and Evolutionary Biology',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Economics (B.A.)',
            'faculty' => 'Arts and Social Sciences',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Economics (B.Sc.)',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Education',
            'faculty' => 'Education',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Education',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Electrical Engineering',
            'faculty' => 'Applied Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Elementary Teacher Education Program (ETEP)',
            'faculty' => 'Education',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Engineering',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Engineering Leadership in Resource Engineering Management',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'English',
            'faculty' => 'Creative and Critical Studies',
            'level' => 'Undergraduate',
        ],[
            'program' => 'English',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'English - Combined Major with English',
            'faculty' => 'Creative and Critical Studies',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Environmental Chemistry',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Fine Arts',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Fine Arts',
            'faculty' => 'Creative and Critical Studies',
            'level' => 'Undergraduate',
        ],[
            'program' => 'French',
            'faculty' => 'Creative and Critical Studies',
            'level' => 'Undergraduate',
        ],[
            'program' => 'French and Spanish',
            'faculty' => 'Creative and Critical Studies',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Freshwater Science',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Gender and Women\'s Studies',
            'faculty' => 'Arts and Social Sciences',
            'level' => 'Undergraduate',
        ],[
            'program' => 'General Science (B.Sc.)',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'General Studies (B.A.)',
            'faculty' => 'Arts and Social Sciences',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Geography',
            'faculty' => 'Arts and Social Sciences',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Geospatial Information Science (Minor)',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Health and Exercise Sciences',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'History',
            'faculty' => 'Arts and Social Sciences',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Human Kinetics',
            'faculty' => 'Health and Social Development',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Indigenous Studies',
            'faculty' => 'Arts and Social Sciences',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Interdisciplinary Graduate Studies',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Interdisciplinary Studies in Contemporary Education (Post-Baccalaureate Certificate)' ,
            'faculty' => 'Education',
            'level' => null,
        
        ],[
            'program' => 'Interdisciplinary Studies in Contemporary Education (Post-Baccalaureate Diploma)' ,
            'faculty' => 'Education',
            'level' => null,
        ],[
            'program' => 'International Relations',
            'faculty' => 'Arts and Social Sciences',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Kinesiology (Ph.D.)',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Latin American Studies',
            'faculty' => 'Arts and Social Sciences',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Management',
            'faculty' => 'Management',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Management',
            'faculty' => 'Management',
            'level' => 'Graduate',
        ],[
            'program' => 'Manufacturing Engineering',
            'faculty' => 'Applied Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Mathematical Sciences',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Mathematics',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Mathematics (B.A.)',
            'faculty' => 'Arts and Social Sciences',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Mathematics (B.Sc.)',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Mechanical Engineering',
            'faculty' => 'Applied Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Media Studies',
            'faculty' => 'Creative and Critical Studies',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Medical Physics',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Medieval and Renaissance Studies (Minor)',
            'faculty' => 'Creative and Critical Studies',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Microbiology',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Nursing',
            'faculty' => 'Health and Social Development',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Nursing (M.S.N.)',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Nursing (Ph.D.)',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Nyslixcn Language',
            'faculty' => 'Arts and Social Sciences',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Philosophy',
            'faculty' => 'Arts and Social Sciences',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Philosophy, Politics, and Economics (PPE)',
            'faculty' => 'Arts and Social Sciences',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Physics and Astronomy',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Political Science',
            'faculty' => 'Arts and Social Sciences',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Psychology',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Psychology (B.A.)',
            'faculty' => 'Arts and Social Sciences',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Psychology (B.Sc.)',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Social Work (Advanced One-Year Program)',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Social Work (Foundational Two-Year Program)',
            'faculty' => 'College of Graduate Studies',
            'level' => 'Graduate',
        ],[
            'program' => 'Sociology',
            'faculty' => 'Arts and Social Sciences',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Spanish',
            'faculty' => 'Creative and Critical Studies',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Statistics',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Sustainability',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Teaching English and Additional Language (TEAL) (Post-Baccalaureate Certificate)',
            'faculty' => 'Education',
            'level' => null,
        ],[
            'program' => 'Theatre (Minor)',
            'faculty' => 'Creative and Critical Studies',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Visual Arts',
            'faculty' => 'Creative and Critical Studies',
            'level' => 'Undergraduate',
        ],[
            'program' => 'Zoology',
            'faculty' => 'Science',
            'level' => 'Undergraduate',
        ]];

        DB::table('programs')->insert($programs);
    }
}
