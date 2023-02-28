<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\Employee;
use Faker\Factory;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    /** @test */
    public function it_can_create_an_employee()
    {
        $faker = Factory::create();

        $data = [
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'email' => $faker->unique()->safeEmail(),
            'phone_number' => $faker->unique()->phoneNumber(),
            'company_id' => Company::factory()->create()->id
        ];
        $response = $this->post(route('companies.employees.store', $data['company_id']), $data);

        $this->assertDatabaseHas('employees', [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'company_id' => $data['company_id'],

        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('companies.employees.index', $data['company_id']));
    }

    /** @test */
    public function it_can_show_an_employee()
    {
        $employee = Employee::factory()->create();

        $response = $this->get(route('companies.employees.show', [$employee->company->id, $employee->id]));

        $response->assertStatus(200);
        $response->assertSee($employee->first_name);
        $response->assertSee($employee->last_name);
        $response->assertSee($employee->email);
        $response->assertSee($employee->phone_number);
    }
}
