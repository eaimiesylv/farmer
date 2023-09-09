<?php

namespace Database\Seeders;

use App\Models\Core\Auth\Role;
use App\Models\Core\Auth\Type;
use App\Models\Core\Notification\NotificationTemplate;
use App\Models\Core\Setting\NotificationAudience;
use App\Models\Core\Setting\NotificationEvent;
use App\Models\Core\Setting\NotificationSetting;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;

class AppVersionUpdateNotificationSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $appTypeId = Type::findByAlias('app')->id;

        foreach ($this->newEvents() as $event) {
            $eventData = [
                'name' => $event,
                'type_id' => $appTypeId,
            ];
            $event = NotificationEvent::query()->create($eventData);
            [$name, $action] = explode('_', $event->name);

            $templates = [
                'system' => '',
                'subject' => '',
                'content' => ''
            ];
            if (array_key_exists($event->name, $this->template())) {
                $templates = $this->template()[$event->name];
            }

            $channels = [];

            $system_notificaiton_not_allowed_list = [];
            if (!in_array($event->name, $system_notificaiton_not_allowed_list)) {
                $database = NotificationTemplate::create([
                    'subject' => null,
                    'default_content' => strtr($templates['system'], [
                        '{resource}' => $name
                    ]),
                    'custom_content' => null,
                    'type' => 'database'
                ]);

                $event->templates()->attach(
                    [$database->id]
                );
                $channels[] = 'database';
            }

            $mail_notificaiton_not_allowed_list = [];
            if (!in_array($event->name, $mail_notificaiton_not_allowed_list)) {
                $mail = NotificationTemplate::query()->create([
                    'subject' => strtr($templates['subject'], [
                        '{resource}' => $name,
                        '{app_name}' => $event->type->alias == 'app' ? '{app_name}' : '{brand_name}'
                    ]),
                    'default_content' => strtr($templates['content'], [
                        '{resource}' => $name,
                        '{button_label}' => 'View ' . ucfirst($name)
                    ]),
                    'custom_content' => null,
                    'type' => 'mail'
                ]);
                $event->templates()->attach(
                    [$mail->id]
                );
                $channels[] = 'mail';
            }

            $adminRoles = Role::query()
                ->where('is_admin', 1)
                ->whereHas('type', function (Builder $query) {
                    $query->where('alias', 'app');
                })->get()
                ->pluck('id');

            $notification_setting = NotificationSetting::query()->create([
                'notification_event_id' => $event->id,
                'notify_by' => $channels
            ]);

            $notification_setting->audiences()->saveMany([
                new NotificationAudience([
                    'audience_type' => 'roles',
                    'audiences' => $adminRoles
                ])
            ]);
        }
        $this->enableForeignKeys();
    }

    public function newEvents()
    {
        return [
            'activity_created',
            'activity_reminder'
        ];
    }

    public function template()
    {
        return [
            // Activity
            'activity_created' => [
                'system' => 'A new activity titled {activity_title} has been created by {action_by}.',
                'subject' => 'A new activity titled {activity_title} has been created in {app_name}',
                'content' => '<p><img src="{app_logo}" style="height: 75px"></p>
<br>
<p><span style="background-color: var(--form-control-bg) ; color: var(--default-font-color) ;">Hi {receiver_name},</span><br></p><p>We are going to inform you that an activity titled {activity_title} has been created by {action_by}. Please have a look at that.</p>
<br>
<p>Activity type: {activity_type}</p>
<p><b>{contextable_title}</b></p>
<p>{activity_description}</p>
<p>Schedule: <a href="https://www.timeanddate.com/worldclock/fixedtime.html?{start_timeanddate_query}">{schedule_start} (UTC)</a> to <a href="https://www.timeanddate.com/worldclock/fixedtime.html?{end_timeanddate_query}">{schedule_end} (UTC)</a></p>
<p>Related to: {contextable_type} </p>
<br>
<br>
<p>Thanks for being with us.</p>
<p>Regards,</p><p>{app_name}</p><p></p><p></p>'
            ],
            'activity_reminder' => [
                'system' => 'Reminder for activity titled {activity_title}.',
                'subject' => 'Reminder for activity titled {activity_title} in {app_name}',
                'content' => '<p><img src="{app_logo}" style="height: 75px"></p>
<br>
<p><span style="background-color: var(--form-control-bg) ; color: var(--default-font-color) ;">Hi {receiver_name},</span><br></p><p>We reminds you that an activity titled {activity_title}, created by {action_by} will held soon. Please have a look at that.</p>
<br>
<p>Activity type: {activity_type}</p>
<p><b>{contextable_title}</b></p>
<p>{activity_description}</p>
<p>Schedule: <a href="https://www.timeanddate.com/worldclock/fixedtime.html?{start_timeanddate_query}">{schedule_start} (UTC)</a> to <a href="https://www.timeanddate.com/worldclock/fixedtime.html?{end_timeanddate_query}">{schedule_end} (UTC)</a></p>
<p>Related to: {contextable_type} </p>
<br>
<br>
<br>
<p>Thanks for being with us.</p>
<p>Regards,</p><p>{app_name}</p><p></p><p></p>'
            ],
        ];
    }
}
