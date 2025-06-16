# Task Management Project
## Test is a project for Skill Test by Nyguyen Huu Dang
### First, find DB table in project root folder: test_db.sql
### Second, import the sql file in MySQL system
### Third, run php artisan serve
### Login creditial information 
####	- username : admin
####	- password : admin

## Enjoy your testing!
## Thank you for your lunch!
=====================
- app/Models/User.php : code changing follow as

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;
class User extends CartalystUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'username',
        'last_name',
        'first_name',
        'permissions',
    ];
    protected $loginNames = ['username'];
}
- php artisan vendor:publish (select a config option)
- change in cartalyst.sentinel follow as:
'users' => [
        'model' => 'App\Models\User',
    ],

- php artisan config:clear
- php artisan config:cache
******
DONE
