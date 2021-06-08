package com.example.carsharingapp;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

public class ClientsDB extends SQLiteOpenHelper{
    private static final String DB_NAME = "oracleClientsDB";
    private static final int DB_VERSION = 1;

    private String SQL_CREATE_CLIENTS =
            "CREATE TABLE IF NOT EXISTS clients (" +
                    "_id INTEGER PRIMARY KEY AUTOINCREMENT," +
                    "name TEXT," +
                    "surname TEXT," +
                    "patronymic TEXT," +
                    "login TEXT," +
                    "password TEXT," +
                    "passport_date INTEGER," +
                    "driver_license_number INTEGER," +
                    "raiting INTEGER);";

    public ClientsDB(Context context)
    {
        super(context, DB_NAME, null, DB_VERSION);
    }
    @Override
    public void onCreate(SQLiteDatabase db) {
        db.execSQL(SQL_CREATE_CLIENTS);
    }
    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion,  int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS clients;");
        onCreate(db);
    }
}
