<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property int $id
 * @property string $venue
 * @property string $address_line_1
 * @property string|null $address_line_2
 * @property string $city
 * @property string|null $state
 * @property string $postcode
 * @property string $country
 * @property string|null $parking_info
 *
 * @property Posts[] $posts
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['venue', 'address_line_1', 'city', 'postcode', 'country'], 'required'],
            [['parking_info'], 'string'],
            [['venue', 'address_line_2'], 'string', 'max' => 255],
            [['address_line_1', 'city', 'state', 'country'], 'string', 'max' => 100],
            [['postcode'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'venue' => 'Venue',
            'address_line_1' => 'Address Line 1',
            'address_line_2' => 'Address Line 2',
            'city' => 'City',
            'state' => 'State',
            'postcode' => 'Postcode',
            'country' => 'Country',
            'parking_info' => 'Parking Info',
        ];
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::class, ['location_id' => 'id']);
    }
}
