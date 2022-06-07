<?php
/**
 *  app/Http/View/Composers/SettingComposer.php
 *
 * User:
 * Date-Time: 13.01.21
 * Time: 16:57
 * @author Insite International <hello@insite.international>
 */

namespace App\Http\View\Composers;

use App\Models\Category;
use App\Models\Localization;
use App\Models\Setting;
use App\Repositories\Frontend\CategoryRepositoryInterface;
use App\Services\CategoryService;
use Illuminate\View\View;

class SettingComposer
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {

        $view->with('categories', $this->categoryRepository->getMainCategories())
            ->with('contact_email', $this->getValue('contact_email'))
            ->with('phone', $this->getValue('phone'))
            ->with('address', $this->getValue('address'))
            ->with('siteFacebook',$this->getValue('facebook'))
            ->with('siteInstagram',$this->getValue('instagram'))
//            ->with('sitePayByCash',$this->getValue('pay_by_cash'))
//            ->with('siteTransfer',$this->getValue('transfer'))
//            ->with('sitePaymentByCard',$this->getValue('payment_by_card'))
//            ->with('siteBankInstallment',$this->getValue('bank_installment'))
//            ->with('siteInternalInstallment',$this->getValue('internal_installment'))
//            ->with('siteRequisiteOne',$this->getValue('requisite_1'))
//            ->with('siteRequisiteTwo',$this->getValue('requisite_2'))
        ;
    }

    protected function getValue($key)
    {
        $setting = Setting::where('key', $key)->first();
        if ($setting == null) {
            return '';
        }
        if (count($setting->availableLanguage) < 1) {
            return '';
        }
        return $setting->availableLanguage[0]->value;
    }

}
