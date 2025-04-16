<?php



namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LeaveApplication;
use App\Models\User;
use App\Models\LeaveStatus;

class LeaveApplicationFactory extends Factory
{
    protected $model = LeaveApplication::class;

    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', 'now');
        $endDate = $this->faker->dateTimeBetween($startDate, strtotime('+5 days', $startDate->getTimestamp()));
        $leaveType = $this->faker->randomElement(['CASUAL', 'MEDICAL', 'HALF_DAY', 'SHORT', 'NO_PAY']);

        return [
            'user_id' => User::factory(),
            'commence_date' => $startDate->format('Y-m-d'),
            'end_date' => $leaveType === 'HALF_DAY' || $leaveType === 'SHORT' ? $startDate->format('Y-m-d') : $endDate->format('Y-m-d'),
            'leave_type' => $leaveType,
            'reason' => $this->faker->sentence(),
            'attachment_url_1' => $this->faker->optional()->imageUrl(),
            'attachment_url_2' => $this->faker->optional()->imageUrl(),
            'attachment_url_3' => $this->faker->optional()->imageUrl(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (LeaveApplication $leaveApplication) {
            LeaveStatus::create([
                'leave_id' => $leaveApplication->id,
                'user_id' => $leaveApplication->user_id,
                'status' => 'PENDING',
            ]);
        });
    }
}