<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\DataTables\LanguageDataTable;
use App\Http\Requests\LanguageRequest;
use App\Services\LangFiles;
use Illuminate\Http\Request;
use Flash;
class LanguageController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the Language.
     *
     * @param LanguageDataTable $languageDataTable
     * @return Response
     */
    public function index(LanguageDataTable $languageDataTable)
    {
        return $languageDataTable->render('admin.languages.index');
    }

    /**
     * Show the form for creating a new Audio.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.languages.create');
    }

    public function store(LanguageRequest $request)
    {
        $input = $request->all();

        try {
            $language = Language::create($input);

            $defaultLang = Language::where('default', 1)->first();

            // Copy the default language folder to the new language folder
            \File::copyDirectory(resource_path('lang/' . $defaultLang->abbr), resource_path('lang/' . request()->input('abbr')));

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.languages')]));

        return redirect(route('admin.languages.index'));
    }


    /**
     * Show the form for creating a new Audio.
     *
     * @return Response
     */
    public function edit($id)
    {
        $language = Language::find($id);

        return view('admin.languages.edit', compact('language'));
    }

    public function update($id, LanguageRequest $request)
    {
        $input = $request->all();

        try {
            $language = Language::update($id, $input);

            $defaultLang = Language::where('default', 1)->first();

            // Copy the default language folder to the new language folder
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.languages')]));

        return redirect(route('admin.languages.index'));
    }

    /**
     * After delete remove also the language folder.
     *
     * @param int $id
     *
     * @return string
     */
    public function destroy($id)
    {
        $language = Language::find($id);

        if (empty($language)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.language')]));

            return redirect(route('admin.languages.index'));
        }

        $destroyResult = Language::delete($id);

        if ($destroyResult) {
            \File::deleteDirectory(resource_path('lang/'.$language->abbr));
        }

        Flash::success(__('lang.deleted', ['operator' => __('lang.language')]));

        return redirect(route('admin.languages.index'));
    }

    public function showTexts(LangFiles $langfile, Language $languages, $lang = '', $file = 'site')
    {
        // SECURITY
        // check if that file isn't forbidden in the config file
        // if (in_array($file, config('backpack.langfilemanager.language_ignore'))) {
        //     abort('403', trans('lang.cant_edit_online'));
        // }

        if ($lang) {
            $langfile->setLanguage($lang);
        }

        $langfile->setFile($file);
        $this->data['currentFile'] = $file;
        $this->data['currentLang'] = $lang ?: config('app.locale');
        $this->data['currentLangObj'] = Language::where('abbr', '=', $this->data['currentLang'])->first();
        $this->data['browsingLangObj'] = Language::where('abbr', '=', config('app.locale'))->first();
        $this->data['languages'] = $languages->orderBy('name')->where('active', 1)->get();
        $this->data['langFiles'] = $langfile->getlangFiles();
        $this->data['fileArray'] = $langfile->getFileContent();
        $this->data['langfile'] = $langfile;
        $this->data['title'] = trans('lang.translations');

        return view('admin.languages.translations', $this->data);
    }

    public function updateTexts(LangFiles $langfile, Request $request, $lang = '', $file = 'site')
    {
        $message = trans('error.error_general');
        $status = false;

        if ($lang) {
            $langfile->setLanguage($lang);
        }

        $langfile->setFile($file);

        $fields = $langfile->testFields($request->all());
        if (empty($fields)) {
            if ($langfile->setFileContent($request->all())) {
                Flash::success(trans('lang.saved'));
                $status = true;
            }
        } else {
            $message = trans('lang.fields_required');
            Flash::error(trans('lang.please_fill_all_fields'));
        }

        return redirect()->back();
    }
}
