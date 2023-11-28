<?

namespace Neti\Favorite\Entity;

use Bitrix\Iblock\ElementTable;
use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\Loader;

class FavoritesTable extends Entity\DataManager
{
    private int $iblockId;
    private int $elementId;

    /**
     * FavoritesTable constructor.
     * @param int $iblockId
     * @param int $elementId
     */
    public function __construct(int $iblockId, int $elementId)
    {
        $this->iblockId = $iblockId;
        $this->elementId = $elementId;
    }

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'neti_favorites';
    }

    /**
     * @return string
     */
    public static function getHlTableName(): string
    {
        return 'NetiFavorites';
    }

    /**
     * @return array
     */
    public static function getMap(): array
    {
        $arFields = [];
        try {
            $arFields = [
                new Entity\IntegerField('ID', [
                    'primary' => true,
                    'autocomplete' => true
                ]),
                new Entity\IntegerField('UF_OWNER'),
                new Entity\IntegerField('UF_IBLOCK'),
                new Entity\IntegerField('UF_ENTITY'),
                new Entity\DatetimeField('UF_DATE'),
                new Entity\ReferenceField(
                    'ELEMENT',
                    'Bitrix\Iblock\ElementTable',
                    [
                        '=this.UF_ENTITY' => 'ref.ID',
                    ]
                ),
            ];
        } catch (\Exception $e) {
        }

        return $arFields;
    }

    /**
     * @return int
     * @throws ArgumentNullException
     * @throws SystemException
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Exception
     */
    public function addElement(): int
    {
        global $USER;
        if (!$USER->IsAuthorized()) {
            throw new SystemException('Error');
        }

        if (!Loader::includeModule('iblock')) {
            throw new \Exception(Loc::getMessage('NETI_FAVORITE_NOT_INSTALL_IBLOCK'));
        }

        $elem = ElementTable::getList([
            'filter' => ['ID' => $this->elementId]
        ])->fetch();

        if (empty($elem)) {
            throw new ArgumentNullException(Loc::getMessage('NETI_FAVORITE_ELEMENT_FIND_ERROR'));
        }

        $userId = $USER->GetID();

        $rs = self::add([
            'UF_OWNER' => $userId,
            'UF_ENTITY' => $this->elementId,
            'UF_IBLOCK' => $this->iblockId,
            'UF_DATE' => new DateTime(),
        ]);

        if ($rs->isSuccess()) {
            $result = $rs->getId();
        } else {
            throw new SystemException(implode(', ', $rs->getErrorMessages()));
        }

        return $result;
    }

    /**
     * @return bool
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ArgumentNullException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     * @throws \Exception
     */
    public function deleteElement(): bool
    {
        global $USER;
        if (!$USER->IsAuthorized()) {
            throw new SystemException('Error');
        }

        if (!Loader::includeModule('iblock')) {
            throw new \Exception(Loc::getMessage('NETI_FAVORITE_NOT_INSTALL_IBLOCK'));
        }

        $elem = self::getList([
            'filter' => ['UF_ENTITY' => $this->elementId, 'UF_IBLOCK' => $this->iblockId]
        ])->fetch();

        if (empty($elem)) {
            throw new ArgumentNullException(Loc::getMessage('NETI_FAVORITE_ELEMENT_FIND_ERROR'));
        }

        $rs = self::delete($elem['ID']);
        if ($rs->isSuccess()) {
            return true;
        }

        throw new  SystemException(implode(', ', $rs->getErrorMessages()));
    }

    /**
     * @param int $userId
     * @return bool
     * @throws SystemException
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Exception
     */
    public static function deleteByUser(): bool
    {
        global $USER;
        if (!$USER->GetID())
            throw new SystemException('Error');

        $ids = FavoritesTable::getList([
            'select' => ['ID'],
            'filter' => ['UF_OWNER' => $USER->GetID()]
        ]);

        if (empty($ids)) return  true;

        foreach ($ids as $id) {
            $rs = self::delete($id);
            if (!$rs->isSuccess()) {
                throw new  SystemException(implode(', ', $rs->getErrorMessages()));
            }
        }

        return true;
    }
}