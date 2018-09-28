<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TeamsSeed::class);

        //DEFAULT
        $this->call(ContentPageSeed::class);
        $this->call(FaqCategorySeed::class);
        $this->call(FaqQuestionSeed::class);
        $this->call(PermissionSeed::class);
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);
        $this->call(RoleSeedPivot::class);
        $this->call(UserSeedPivot::class);

        //DUMMY DATA        
        $this->call(CoursesSeed::class);
        $this->call(LessonsSeed::class);
        $this->call(TrailsSeed::class);

        $this->call(CourseCategoriesSeed::class);
        $this->call(CoursesCertificatesSeed::class);
        $this->call(CourseTagsSeed::class);
        $this->call(TrailCategoriesSeed::class);        
        $this->call(TrailsCertificatesSeed::class);
        $this->call(TrailTagsSeed::class);

        $this->call(CourseCourseTagSeed::class);
        $this->call(CourseLessonSeed::class);        
        $this->call(CourseUserSeed::class);           
        $this->call(TrailTrailCategorySeed::class);
        $this->call(TrailTrailtagSeed::class);        
        $this->call(CourseTrailSeed::class);
        $this->call(CourseCourseCategorySeed::class);

        //$this->call(DataCoursesSeed::class);
        //$this->call(DataTrailsSeed::class);
        
    }
}
