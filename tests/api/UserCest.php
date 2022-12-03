<?php

use Codeception\Util\JsonType;

class UserCest
{
    public function getById(ApiTester $I): void
    {
        $I->haveHttpHeader('accept', 'application/json');
        $I->sendGET(route('get', ['id' => 1]));
        $jsonType = new JsonType(['data']);
        $jsonType->matches([
            'data' => 'object:!empty',
        ]);
        $I->seeResponseContainsJson([
            'data' => [
                'id' => 1,
                'imageUrl' => '',
                'name' => 'USER #1',
                'email' => 'user1@mail.mail',
                'emailVerifiedAt' => '1970-01-01 00:00:00',
                'createdAt' => '1970-01-01 00:00:00',
                'updatedAt' => '1970-01-01 00:00:00',
                'hobbies' => []
            ],
        ]);
        $I->seeResponseCodeIs(200);
    }

    public function getWithFilters(ApiTester $I): void
    {
        $I->haveHttpHeader('accept', 'application/json');
        $I->sendGET(route('getAll', [

            'limit' => 2,
            'page' => 1,
            'sortField' => 'id',
            'sortOrder' => 'desc',
        ]));
        $jsonType = new JsonType(['data']);
        $jsonType->matches([
            'data' => 'object:!empty',
        ]);
        $I->seeResponseContainsJson([
            'data' => [
                [
                    'id' => 3,
                    'name' => 'USER #3',
                    'email' => 'user3@mail.mail',
                    'emailVerifiedAt' => '1970-03-03 00:00:00',
                    'createdAt' => '1970-03-03 00:00:00',
                    'updatedAt' => '1970-03-03 00:00:00',
                ],
                [
                    'id' => 2,
                    'name' => 'USER #2',
                    'email' => 'user2@mail.mail',
                    'emailVerifiedAt' => '1970-02-02 00:00:00',
                    'createdAt' => '1970-02-02 00:00:00',
                    'updatedAt' => '1970-02-02 00:00:00',
                ],
            ],
            'links' => [],
            'meta' => [],
        ]);
        $I->seeResponseCodeIs(200);
    }
}
