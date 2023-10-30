<?php

namespace App\Actions;

use App\Enum\Currency;
use App\Enum\SettingEnum as AppSetting;
use App\Models\Setting;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 * @method run(Currency $currency): Setting
 */
class GetCompanyAccountAction
{
    use AsAction;

    public function handle(Currency $currency): Setting
    {
        if($currency === Currency::NGN) {
            return Setting::where('key', AppSetting::NGN_ACCOUNT)->get()->last();
        }
        else if($currency === Currency::GHC) {
            return Setting::where('key', AppSetting::GHC_ACCOUNT)->get()->last();
        }

        throw new \Exception('Invalid currency');
    }
}
