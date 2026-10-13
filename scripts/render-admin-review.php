<?php
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
config(['database.default'=>'sqlite','database.connections.sqlite.database'=>':memory:']);
view()->share('errors', new Illuminate\Support\MessageBag);
$record = new App\Models\Appointment(['patient_name'=>'Mobile Review Patient','department'=>'General Medicine','phone'=>'9876543210','email'=>'long.email.address.for.layout@example.com','preferred_date'=>today(),'time_slot'=>'Morning','status'=>'pending']);
$record->id = 1;
$pages = [
'dashboard'=>['admin.dashboard', ['stats'=>['today_appointments'=>12,'pending_appointments'=>8,'unread_messages'=>3,'active_doctors'=>24,'active_departments'=>12,'published_blogs'=>18], 'todayAppointments'=>collect([$record]), 'recentMessages'=>collect(), 'departmentDemand'=>collect()]],
'appointments'=>['admin.operations', ['section'=>'appointments','records'=>new Illuminate\Pagination\LengthAwarePaginator([$record],1,15)]],
'doctor'=>['admin.doctors.form',['doctor'=>new App\Models\Doctor,'departments'=>collect()]],
'settings'=>['admin.settings.edit',['settings'=>new App\Models\SiteSetting]],
'login'=>['admin.auth.login',[]],
];
foreach ($pages as $name => [$view,$data]) {
$html = view($view,$data)->render();
$html = preg_replace('~<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>~','',$html);
$html = preg_replace('~<link rel="stylesheet" href="[^"]*admin-responsive.css[^"]*">~','<style>'.file_get_contents(public_path('css/admin-responsive.css')).'</style>',$html);
$html = preg_replace('~<script src="[^"]*admin-navigation.js[^"]*"></script>~','<script>'.file_get_contents(public_path('js/admin-navigation.js')).'</script>',$html);
file_put_contents(__DIR__.'/../storage/app/admin-review-'.$name.'.html',$html);
}
echo "Rendered five admin review pages.\n";
