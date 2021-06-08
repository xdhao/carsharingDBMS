package com.example.carsharingapp;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

public class CarsDB extends SQLiteOpenHelper{
    private static final String DB_NAME = "postgreCarsDB";
    private static final int DB_VERSION = 3;

    private String SQL_CREATE_CARS =
            "CREATE TABLE IF NOT EXISTS cars (" +
                    "_id INTEGER PRIMARY KEY AUTOINCREMENT," +
                    "year INTEGER," +
                    "fuel_level REAL," +
                    "environmental_class INTEGER," +
                    "lat REAL," +
                    "lng REAL," +
                    "id_body_type INTEGER," +
                    "id_color INTEGER," +
                    "id_brand INTEGER," +
                    "FOREIGN KEY (id_body_type) REFERENCES body_types(id)," +
                    "FOREIGN KEY (id_color) REFERENCES colors(id)," +
                    "FOREIGN KEY (id_brand) REFERENCES brands(id));";
    private String SQL_CREATE_BRANDS =
            "CREATE TABLE IF NOT EXISTS brands (" +
                    "_id INTEGER PRIMARY KEY AUTOINCREMENT," +
                    "name TEXT);";
    private String SQL_CREATE_COLORS =
            "CREATE TABLE IF NOT EXISTS colors (" +
                    "_id INTEGER PRIMARY KEY AUTOINCREMENT," +
                    "name TEXT);";
    private String SQL_CREATE_BODY_TYPES =
            "CREATE TABLE IF NOT EXISTS body_types (" +
                    "_id INTEGER PRIMARY KEY AUTOINCREMENT," +
                    "name TEXT);";

    public CarsDB(Context context)
    {
        super(context, DB_NAME, null, DB_VERSION);
    }
    @Override
    public void onCreate(SQLiteDatabase db) {
        db.execSQL(SQL_CREATE_BRANDS);
        db.execSQL(SQL_CREATE_COLORS);
        db.execSQL(SQL_CREATE_BODY_TYPES);
        db.execSQL(SQL_CREATE_CARS);
    }
    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion,  int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS cars;");
        db.execSQL("DROP TABLE IF EXISTS brands;");
        db.execSQL("DROP TABLE IF EXISTS models;");
        db.execSQL("DROP TABLE IF EXISTS body_types;");
        onCreate(db);
    }
}
