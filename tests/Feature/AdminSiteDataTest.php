<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminSiteDataTest extends TestCase
{
    public function test_admin_site_data_page_can_be_rendered(): void
    {
        $response = $this->get('/admin/site-data');

        $response->assertStatus(200);
        $response->assertSee('Kelola Data Website');
    }

    public function test_admin_can_store_site_data(): void
    {
        $response = $this->post('/admin/site-data', [
            'hero_title' => 'Desa Cantik Baru',
            'hero_description' => 'Deskripsi baru untuk website',
            'stat_population' => '5555',
        ]);

        $response->assertRedirect('/admin/site-data');
        $this->assertDatabaseHas('site_contents', [
            'key' => 'hero_title',
            'value' => 'Desa Cantik Baru',
        ]);
    }
}
