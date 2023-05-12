<?php

namespace MicroweberPackages\Template\tests;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MicroweberPackages\Core\tests\TestCase;
use MicroweberPackages\User\Models\User;

/**
 * @runTestsInSeparateProcesses
 */
class TemplateServiceProviderBootTest extends TestCase
{
    public $template_name = 'new-world';

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testTemplateServiceProviderIsLoaded()
    {
        $this->setPreserveGlobalState(false);
        $templateName = $this->template_name;
        save_option('current_template', $this->template_name, 'template');
        $current_template = app()->option_manager->get('current_template', 'template');

        $user = User::where('is_admin', '=', '1')->first();
        Auth::login($user);
        $url = 'testTemplateServiceProviderIsLoaded' . uniqid();
        $newCleanPageId = save_content([
            'subtype' => 'dynamic',
            'content_type' => 'page',
            'title' => 'testTemplateServiceProviderIsLoaded',
            'url' => $url,
            'active_site_template' => $templateName,
            'is_active' => 1,
        ]);

        app()->content_manager->define_constants(['id' => $newCleanPageId]);
        app()->template->boot();
        $this->assertEquals($templateName, app()->template->folder_name());
        $expected = 'MicroweberPackages\Template\NewWorld\TemplateServiceProvider';
        $this->assertNotEmpty(app()->getProviders($expected));
        $found = false;
        $loaded = app()->getLoadedProviders();
        foreach ($loaded as $key) {
            if ($key == $expected) {
                $found = true;
            }
        }
        $this->assertTrue($found);

        // check form migration in db table
        $file = '2021_08_24_132521_update_new_world_template_edit_field_names';
        $check = DB::table('migrations')->where('migration', $file)->first();

    }


}
