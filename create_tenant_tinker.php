 $tenant1 = App\Models\Tenant::create();
 $tenant1->domains()->create(['domain' => 'tenant2']);