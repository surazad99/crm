<?php

namespace Tests\Unit;

// use Faker\Factory;

use App\Models\Company;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class CompanyTest extends TestCase
{
    /** @test */
    public function it_can_create_a_company()
    {
        $faker = Factory::create();

        $companyName = $faker->company;
        $email = $faker->companyEmail;
        $website = $faker->url;
        $data = [
            'name' => $companyName,
            'email' => $email,
            'logo' => UploadedFile::fake()->image('logo.png', 100, 100),
            'website' => $website,
        ];
        $response = $this->post(route('companies.store'), $data);

        $this->assertDatabaseHas('companies', [
            'name' => $companyName,
            'email' => $email,
            'website' => $website,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('companies.index'));
    }

    /** @test */
    public function it_can_show_a_company()
    {
        $company = Company::factory()->create();

        $response = $this->get(route('companies.show', $company->id));

        $response->assertStatus(200);
        $response->assertSee($company->name);
        $response->assertSee($company->email);
        $response->assertSee($company->website);
    }

    /** @test */
    public function it_can_update_a_company()
    {
        $company = Company::factory()->create();
        $faker = Factory::create();

        $companyName = $faker->company;
        $email = $faker->companyEmail;
        $website = $faker->url;
        $data = [
            'name' => $companyName,
            'email' => $email,
            'logo' => UploadedFile::fake()->image('logo.png', 100, 100),
            'website' => $website,
        ];

        $response = $this->put(route('companies.update', $company->id), $data);

        $this->assertDatabaseHas('companies', [
            'id' => $company->id,
            'name' => $companyName,
            'email' => $email,
            'website' => $website,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('companies.index'));
    }

    /** @test */
    public function it_can_delete_a_company()
    {
        $company = Company::factory()->create();


        $response = $this->delete(route('companies.destroy', $company->id));

        $this->assertDeleted('companies', [
            'id' => $company->id,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('companies.index'));
    }
    
    /** @test */
    public function it_can_display_a_list_of_companies()
    {
        $company1 = Company::factory()->create();
        $company2 = Company::factory()->create();


        $response = $this->get(route('companies.index'));

        $response->assertStatus(200);
        $response->assertSee($company1->id);
        $response->assertSee($company2->id);

    }
}
