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
        
        $this->call(PermissionSeed::class);
        $this->call(TeamSeed::class);  
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);
        $this->call(RoleSeedPivot::class);
        $this->call(UserSeedPivot::class);
        $this->call(CourseSeed::class);
        $this->call(LessonSeed::class);
        $this->call(CourseLessonSeed::class);
        $this->call(CoursesCategoriesSeed::class);
        $this->call(TrialSeed::class);
        $this->call(TrialCategorySeed::class);
        $this->call(CourseCoursesCategorySeed::class);
        $this->call(CourseTrailSeed::class);
        $this->call(CourseUserSeed::class);
        $this->call(TrialTrialCategorySeed::class);
    }
}
