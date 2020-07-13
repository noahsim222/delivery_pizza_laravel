<?php

namespace App\Services;

use App\Exceptions\UnexpectedErrorException;
use App\Models\Category;
use App\Models\Language;
use App\Repositories\Contracts\CategoryRepository;
use App\Services\Traits\ServiceTranslateTable;
use Illuminate\Database\DatabaseManager;
use Illuminate\Log\Logger;
use Illuminate\Support\Arr;
use App\Services\Contracts\CategoryService as CategoryServiceInterface;

/**
 * @method bool destroy
 */
class CategoryService  extends BaseService implements CategoryServiceInterface
{
    use ServiceTranslateTable;

    /**
     * @var DatabaseManager $databaseManager
     */
    protected $databaseManager;

    /**
     * @var CategoryRepository $repository
     */
    protected $repository;

    /**
     * Language $language
     */
    protected $language;

    /**
     * @var Logger $logger
     */
    protected $logger;

    /**
     * CategoryService constructor.
     *
     * @param DatabaseManager $databaseManager
     * @param CategoryRepository $repository
     * @param Language $language
     * @param Logger $logger
     */
    public function __construct(
        DatabaseManager $databaseManager,
        CategoryRepository $repository,
        Language $language,
        Logger $logger
    ) {

        $this->databaseManager = $databaseManager;
        $this->repository      = $repository;
        $this->logger          = $logger;
        $this->language        = $language;
    }

    /**
     * @param array $data
     * @return Category
     * @throws \Throwable
     */
    public function store(array $data)
    {
        $this->beginTransaction();
        try {
            /** @var Category $category */
            $category = $this->repository->newInstance();
            $category->icon = array_get($data, 'icon');

            if (!$category->save()) {
                throw new UnexpectedErrorException('Category was not saved to the database.');
            }
            $this->logger->info('Category was successfully saved to the database.');

            $this->storeTranslations($category, $data, $this->getTranslationSelectColumnsClosure());
            $this->logger->info('Translations for the Category were successfully saved.', ['category_id' => $category->id]);

        } catch (UnexpectedErrorException $e) {
            $this->rollback($e, 'An error occurred while storing an ', [
                'data' => $data,
            ]);
        }

        $this->commit();
        return $category;
    }

    /**
     * Update block in the storage.
     *
     * @param  int  $id
     * @param  array  $data
     *
     * @return Category
     *
     * @throws
     */
    public function update($id, array $data)
    {
        $this->beginTransaction();
        try {
            /** @var Category $category */
            $category = $this->repository->find($id);
            $category->icon = array_get($data, 'icon');

            if (!$category->save()) {
                throw new UnexpectedErrorException('An error occurred while updating a Category');
            }
            $this->logger->info('Category was successfully updated.');

            $this->storeTranslations($category, $data, $this->getTranslationSelectColumnsClosure());
            $this->logger->info('Category translations was successfully updated.');

        } catch (UnexpectedErrorException $e) {
            $this->rollback($e, 'An error occurred while updating an Categorys.', [
                'id'   => $id,
                'data' => $data,
            ]);

        }
        $this->commit();
        return $category;
    }

    /**
     * Delete category.
     *
     * @param  int  $id
     *
     * @return array
     *
     * @throws
     */
    public function delete($id)
    {

        $this->beginTransaction();

        try {
            $bufferCategory = [];
            $category = $this->repository->find($id);

            $bufferCategory['id'] = $category->id;
            $bufferCategory['name'] = $category->name;

            if (!$category->delete($id)) {
                throw new UnexpectedErrorException(
                    'Category and Category translations was not deleted from database.'
                );
            }
            $this->logger->info('Category Category was successfully deleted from database.');
        } catch (UnexpectedErrorException $e) {
            $this->rollback($e, 'An error occurred while deleting an Category.', [
                'id'   => $id,
            ]);
        }
        $this->commit();
        return $bufferCategory;
    }

    /**
     * Closure that handles translation for storing in the database.
     *
     * @return \Closure
     */
    protected function getTranslationSelectColumnsClosure()
    {
        return function ($translation) {
            return [
                'name' => Arr::get($translation, 'name'),
            ];
        };
    }
}
