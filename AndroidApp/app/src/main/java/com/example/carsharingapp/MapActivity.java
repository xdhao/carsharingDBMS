package com.example.carsharingapp;

import androidx.appcompat.app.AppCompatActivity;
import android.content.ContentValues;
import android.content.Intent;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.SimpleCursorAdapter;
import android.widget.TextView;

public class MapActivity extends AppCompatActivity{
    TextView textName;
    TextView textColor;
    TextView textClass;
    TextView textFuel;
    ListView carsList;

    CarsDB sqlHelper;
    SQLiteDatabase db;
    Cursor carCursor;
    SimpleCursorAdapter mainAdapter;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_map);

        textName = (TextView) findViewById(R.id.textName);
        textColor = (TextView) findViewById(R.id.textColor);
        textClass = (TextView) findViewById(R.id.textClass);
        textFuel = (TextView) findViewById(R.id.textFuel);
        carsList = (ListView) findViewById(R.id.list);
        carsList.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                showCar(id);
            }
        });

        sqlHelper = new CarsDB(this);
    }
    @Override
    public void onResume() {
        super.onResume();
        showList();
    }
    public void showList()
    {
        db = sqlHelper.getReadableDatabase();

        carCursor =  db.rawQuery("select * from cars", null);
        String[] headers = new String[] {"lat", "lng"};

        mainAdapter = new SimpleCursorAdapter(this, android.R.layout.two_line_list_item,
                carCursor, headers, new int[]{android.R.id.text1, android.R.id.text2}, 0);

        carsList.setAdapter(mainAdapter);
    }
    public void goSettings(View view){
        db.close();
        Intent intent = getIntent();
        Long id = intent.getLongExtra("user_id", 0);
        intent = new Intent(this, SettingsActivity.class);
        intent.putExtra("user_id", id);
        startActivity(intent);
    }
    public void addCars(View view){
        db = sqlHelper.getWritableDatabase();
        carCursor = db.rawQuery("SELECT * FROM brands", null);
        if (carCursor.getCount() == 0)
        {
            ContentValues brand = new ContentValues();
            brand.put("_id", 1);
            brand.put("name", "Ford");
            db.insert("brands", null, brand);
            brand.clear();
            brand.put("_id", 2);
            brand.put("name", "Renault");
            db.insert("brands", null, brand);
            brand.clear();
            brand.put("_id", 3);
            brand.put("name", "Hyundai");
            db.insert("brands", null, brand);
        }

        carCursor = db.rawQuery("SELECT * FROM colors", null);
        if (carCursor.getCount() == 0)
        {
            ContentValues color = new ContentValues();
            color.put("_id", 1);
            color.put("name", "серебристый");
            db.insert("colors", null, color);
            color.clear();
            color.put("_id", 2);
            color.put("name", "красный");
            db.insert("colors", null, color);
            color.clear();
            color.put("_id", 3);
            color.put("name", "черный");
            db.insert("colors", null, color);
        }

        carCursor = db.rawQuery("SELECT * FROM body_types", null);
        if (carCursor.getCount() == 0)
        {
            ContentValues body_type = new ContentValues();
            body_type.put("_id", 1);
            body_type.put("name", "седан");
            db.insert("body_types", null, body_type);
            body_type.clear();
            body_type.put("_id", 2);
            body_type.put("name", "хэтчбэк");
            db.insert("body_types", null, body_type);
            body_type.clear();
            body_type.put("_id", 3);
            body_type.put("name", "кроссовер");
            db.insert("body_types", null, body_type);
        }

        ContentValues car = new ContentValues();
        car.put("year", 2018);
        car.put("fuel_level", 5);
        car.put("environmental_class", 1);
        car.put("lat", 102546);
        car.put("lng", 104555);
        car.put("id_body_type", 1);
        car.put("id_color", 1);
        car.put("id_brand", 1);
        db.insert("cars", null, car);
        car.clear();
        car.put("year", 2019);
        car.put("fuel_level", 4);
        car.put("environmental_class", 2);
        car.put("lat", 156556);
        car.put("lng", 133033);
        car.put("id_body_type", 2);
        car.put("id_color", 2);
        car.put("id_brand", 2);
        db.insert("cars", null, car);
        car.clear();
        car.put("year", 2020);
        car.put("fuel_level", 3);
        car.put("environmental_class", 3);
        car.put("lat", 198888);
        car.put("lng", 100001);
        car.put("id_body_type", 3);
        car.put("id_color", 3);
        car.put("id_brand", 3);
        db.insert("cars", null, car);

        showList();
    }
    public void deleteCars(View view){
        db = sqlHelper.getWritableDatabase();
        db.delete("cars", null, null);
        db.delete("brands", null, null);
        db.delete("colors", null, null);
        db.delete("body_types", null, null);

        showList();
    }
    public void showCar(Long id){
        db = sqlHelper.getReadableDatabase();
        carCursor = db.rawQuery("SELECT * FROM cars WHERE _id=?", new String[]{id.toString()});
        carCursor.moveToFirst();
        Integer carYear = carCursor.getInt(1);
        Float carFuel = carCursor.getFloat(2);
        Integer carEnv = carCursor.getInt(3);
        Integer bodyId = carCursor.getInt(6);
        Integer colorId = carCursor.getInt(7);
        Integer brandId = carCursor.getInt(8);
        carCursor = db.rawQuery("SELECT * FROM body_types WHERE _id=?", new String[]{bodyId.toString()});
        carCursor.moveToFirst();
        String carBody = carCursor.getString(1);
        carCursor = db.rawQuery("SELECT * FROM colors WHERE _id=?", new String[]{colorId.toString()});
        carCursor.moveToFirst();
        String carColor = carCursor.getString(1);
        carCursor = db.rawQuery("SELECT * FROM brands WHERE _id=?", new String[]{brandId.toString()});
        carCursor.moveToFirst();
        String carBrand = carCursor.getString(1);

        textName.setText(carBrand + ", " + carYear.toString() + ", " + carBody);
        textColor.setText("Цвет " + carColor);
        textClass.setText("Класс безопасности " + carEnv);
        textFuel.setText("Осталось топлива " + carFuel.toString() + " л.");
    }
    @Override
    public void onDestroy(){
        super.onDestroy();

        db.close();
        carCursor.close();
    }
}
