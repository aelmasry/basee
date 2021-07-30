<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use Flash;
use App\Http\Controllers\Controller;
use App\Repositories\UploadRepository;
use Response;
use Alert;
class CategoryController extends Controller
{
    /** @var  CategoryRepository */
    private $categoryRepository;
    private $uploadRepository;

    private $name;

    public function __construct(CategoryRepository $categoryRepo, UploadRepository $uploadRepo)
    {
        $this->categoryRepository = $categoryRepo;
        $this->uploadRepository = $uploadRepo;

        $this->name = 'name_'.app()->getLocale();
    }

    /**
     * Display a listing of the Category.
     *
     * @param CategoryDataTable $categoryDataTable
     * @return Response
     */
    public function index(CategoryDataTable $categoryDataTable)
    {
        return $categoryDataTable->render('admin.categories.index');
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->where('parent_id', 0)->pluck($this->name, 'id');

        return view('admin.categories.create', compact(['categories']));
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param CategoryRequest $request
     *
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        $input = $request->all();
        $input['parent_id'] = ($input['parent_id']) ?? 0;

        try {
            $category = $this->categoryRepository->create($input);
            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($category, 'category');
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success('saved successfully.');
        // Alert::success('saved successfully.');

        return redirect(route('admin.categories.index'));
    }

    /**
     * Display the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('admin.categories.index'));
        }

        return view('admin.categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        $categories = $this->categoryRepository->where('parent_id', 0)->pluck($this->name, 'id');
        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('admin.categories.index'));
        }

        return view('admin.categories.edit')
                ->with([
                    'category' => $category,
                    'categories' => $categories
                ]);
    }

    /**
     * Update the specified Category in storage.
     *
     * @param  int              $id
     * @param CategoryRequest $request
     *
     * @return Response
     */
    public function update($id, CategoryRequest $request)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('admin.categories.index'));
        }

        $input = $request->all();
        $input['parent_id'] = ($input['parent_id']) ?? 0;

        try {
            $category = $this->categoryRepository->update($input, $id);
            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($category, 'category');
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }


        // Flash::success('Category updated successfully.');
        // Alert::success(__('lang.saved_successfully', ['operator' => __('lang.category')]));
        // \Alert::add('success', '<strong>Got it</strong><br>This is HTML in a green bubble.');
        Alert::success('You have successfully logged in')->flash();



        return redirect(route('admin.categories.index'));
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('admin.categories.index'));
        }

        $this->categoryRepository->delete($id);

        Flash::success('Category deleted successfully.');

        return redirect(route('admin.categories.index'));
    }

    /**
     * Remove Media of Author
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $category = $this->categoryRepository->findWithoutFail($input['id']);
        try {
            if ($category->hasMedia($input['collection'])) {
                $category->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
