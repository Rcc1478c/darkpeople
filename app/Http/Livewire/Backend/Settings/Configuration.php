<?php

namespace App\Http\Livewire\Backend\Settings;

use Livewire\Component;
use App\Models\Setting;

class Configuration extends Component {

    /**
     * Components State
     */
    public $state = [
        'domains' => [],
        'fetch_seconds' => 0,
        'fetch_messages_limit' => 15,
        'forbidden_ids' => [],
        'blocked_domains' => [],
        'cron_password' => '',
        'delete' => [],
        'random' => [],
        'custom' => [],
        'after_last_email_delete' => 'redirect_to_homepage',
        'date_format' => 'd M Y h:i A',
        'recaptcha' => []
    ];

    public function mount() {
        foreach ($this->state as $key => $props) {
            $this->state[$key] = config('app.settings')[$key];
        }
        if ($this->state['random']['start'] || $this->state['random']['end']) {
            $this->state['advance_random'] = true;
        } else {
            $this->state['advance_random'] = false;
        }
    }

    public function add($type = 'domains') {
        $this->resetErrorBag();
        array_push($this->state[$type], '');
    }

    public function remove($type = 'domains', $key = 0) {
        unset($this->state[$type][$key]);
        $this->state[$type] = array_values($this->state[$type]);
    }

    public function update() {
        $this->validate(
            [
                'state.domains.0' => 'required',
                'state.domains.*' => 'required',
                'state.forbidden_ids.*' => 'required',
                'state.blocked_domains.*' => 'required',
                'state.fetch_seconds' => 'required|numeric',
                'state.fetch_messages_limit' => 'required|numeric',
                'state.cron_password' => 'required',
                'state.delete.value' => 'required|numeric',
                'state.custom.max' => 'gte:' . $this->state['custom']['min'],
                'state.random.end' => 'gte:' . $this->state['random']['start'],
                'state.date_format' => 'required'
            ],
            [
                'state.domains.0.required' => 'Atleast one Domain is Required',
                'state.domains.*.required' => 'Domain field is Required',
                'state.forbidden_ids.*.required' => 'Forbidden ID field is Required',
                'state.blocked_domains.*.required' => 'Blocked Domain field is Required',
                'state.fetch_seconds.required' => 'Fetch Seconds field is Required',
                'state.fetch_seconds.numeric' => 'Fetch Seconds field can only be Numeric',
                'state.fetch_messages_limit.required' => 'Fetch Messages Limit field is Required',
                'state.fetch_messages_limit.numeric' => 'Fetch Messages Limit field can only be Numeric',
                'state.cron_password.required' => 'CRON Password field is Required',
                'state.delete.value.required' => 'Delete Value field is Required',
                'state.delete.value.numeric' => 'Delete Value field can only be Numeric',
                'state.custom.max.gte' => 'Custom Max Length must be greater than or equal to ' . $this->state['custom']['min'],
                'state.random.end.gte' => 'Random End must be greater than or equal to ' . $this->state['random']['start'],
                'state.date_format.required' => 'Date Format field is Required'
            ]
        );
        if ($this->state['recaptcha']['enabled']) {
            $this->validate(
                [
                    'state.recaptcha.site_key' => 'required',
                    'state.recaptcha.secret_key' => 'required'
                ],
                [
                    'state.recaptcha.site_key.required' => 'Site Key is Required',
                    'state.recaptcha.secret_key.required' => 'Secret Key is Required'
                ]
            );
        }
        if (!$this->state['advance_random']) {
            $this->state['random']['start'] = 0;
            $this->state['random']['end'] = 0;
        }
        $settings = Setting::whereIn('key', ['domains', 'fetch_seconds', 'fetch_messages_limit', 'forbidden_ids', 'blocked_domains', 'cron_password', 'delete', 'random', 'custom', 'after_last_email_delete', 'date_format', 'recaptcha'])->get();
        foreach ($settings as $setting) {
            $setting->value = serialize($this->state[$setting->key]);
            $setting->save();
        }
        $this->emit('saved');
    }

    public function render() {
        return view('backend.settings.configuration');
    }
}
