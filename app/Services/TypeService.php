<?php

namespace App\Services;

use App\Exceptions\UnexpectedErrorException;
use App\Models\Type;
use App\Models\Language;
use App\Repositories\Contracts\TypeRepository;
use App\Services\Traits\ServiceTranslateTable;
use Illuminate\Database\DatabaseManager;
use Illuminate\Log\Logger;
use Illuminate\Support\Arr;
use App\Services\Contracts\TypeService as TypeServiceInterface;

/**
 * @method bool destroy
 */
class TypeService  extends BaseService implements TypeServiceInterface
{
    use ServiceTranslateTable;

    /**
     * @var DatabaseManager $databaseManager
     */
    protected $databaseManager;

    /**
     * @var TypeRepository $repository
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
     * TypeService constructor.
     *
     * @param DatabaseManager $databaseManager
     * @param TypeRepository $repository
     * @param Language $language
     * @param Logger $logger
     */
    public function __construct(
        DatabaseManager $databaseManager,
        TypeRepository $repository,
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
     * @return Type
     * @throws \Throwable
     */
    public function store(array $data)
    {
        $this->beginTransaction();
        try {
            /** @var Type $type */
            $type = $this->repository->newInstance();
            $type->code = array_get($data, 'code');

            if (!$type->save()) {
                throw new UnexpectedErrorException('Type was not saved to the database.');
            }
            $this->logger->info('Type was successfully saved to the database.');

            $this->storeTranslations($type, $data, $this->getTranslationSelectColumnsClosure());
            $this->logger->info('Translations for the Type were successfully saved.', ['type_id' => $type->id]);

        } catch (UnexpectedErrorException $e) {
            $this->rollback($e, 'An error occurred while storing an ', [
                'data' => $data,
            ]);
        }

        $this->commit();
        return $type;
    }

    /**
     * Update block in the storage.
     *
     * @param  int  $id
     * @param  array  $data
     *
     * @return Type
     *
     * @throws
     */
    public function update($id, array $data)
    {
        $this->beginTransaction();
        try {
            /** @var Type $type */
            $type = $this->repository->find($id);
            $type->code = array_get($data, 'code');

            if (!$type->save()) {
                throw new UnexpectedErrorException('An error occurred while updating a Type');
            }
            $this->logger->info('Type was successfully updated.');

            $this->storeTranslations($type, $data, $this->getTranslationSelectColumnsClosure());
            $this->logger->info('Type translations was successfully updated.');

        } catch (UnexpectedErrorException $e) {
            $this->rollback($e, 'An error occurred while updating an Types.', [
                'id'   => $id,
                'data' => $data,
            ]);

        }
        $this->commit();
        return $type;
    }

    /**
     * Delete type.
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
            $bufferType = [];
            $type = $this->repository->find($id);

            $bufferType['id'] = $type->id;
            $bufferType['name'] = $type->name;

            if (!$type->delete($id)) {
                throw new UnexpectedErrorException(
                    'Type and Type translations was not deleted from database.'
                );
            }
            $this->logger->info('Type Type was successfully deleted from database.');
        } catch (UnexpectedErrorException $e) {
            $this->rollback($e, 'An error occurred while deleting an Type.', [
                'id'   => $id,
            ]);
        }
        $this->commit();
        return $bufferType;
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
