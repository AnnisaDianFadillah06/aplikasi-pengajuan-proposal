<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PengajuanProposal;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengajuanProposal>
 */
class PengajuanProposalFactory extends Factory
{
    protected $model = PengajuanProposal::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kegiatan' => $this->faker->sentence(3), // Contoh: "Seminar Teknologi Modern"
            'tgl_kegiatan' => $this->faker->date(), // Contoh: "2024-10-01"
            'tmpt_kegiatan' => $this->faker->address(), // Contoh: "Jl. Merdeka No. 10, Bandung"
            'file_proposal' => $this->faker->word() . '.pdf', // Contoh: "proposal_teknologi.pdf"
            'id_jenis_kegiatan' => $this->faker->numberBetween(1, 2), // Contoh: random ID jenis kegiatan
            'id_ormawa' => $this->faker->numberBetween(1, 3), // Contoh: random ID ormawa
            'id_pengguna' => $this->faker->numberBetween(1, 5), // Contoh: random ID pengguna
            'file_lpj' => $this->faker->word() . '.pdf', // Contoh: "lpj_kegiatan.pdf"
            'created_by' => $this->faker->numberBetween(1, 10), // Contoh: random ID pengguna yang membuat
            'updated_by' => $this->faker->numberBetween(1, 10), // Contoh: random ID pengguna yang mengupdate
        ];
    }
}
