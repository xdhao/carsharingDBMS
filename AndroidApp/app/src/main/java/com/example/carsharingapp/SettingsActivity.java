package com.example.carsharingapp;

import androidx.appcompat.app.AppCompatActivity;
import android.content.ContentValues;
import android.content.Intent;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.os.Bundle;
import android.view.View;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.TextView;

public class SettingsActivity extends AppCompatActivity{
    EditText loginBox;
    EditText passwordBox;
    CheckBox checkFilter1;
    TextView messageBox;

    ClientsDB sqlHelper;
    SQLiteDatabase db2;
    Cursor clientCursor;
    long selectedId=0;
    @Override
    protected void onCreate(Bundle savedInstanceState){
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_settings);

        loginBox = (EditText) findViewById(R.id.changeLogin);
        passwordBox = (EditText) findViewById(R.id.changePassword);
        checkFilter1 = (CheckBox) findViewById(R.id.checkFilter1);
        messageBox = (TextView) findViewById(R.id.messageLabel2);

        sqlHelper = new ClientsDB(this);
        db2 = sqlHelper.getWritableDatabase();

        Bundle extras = getIntent().getExtras();
        if (extras != null) {
            selectedId = extras.getLong("user_id");
        }
        // если 0, то добавление
        if (selectedId > 0) {
            // получаем элемент по id из бд
            clientCursor = db2.rawQuery("SELECT * FROM clients WHERE _id = ?", new String[]{String.valueOf(selectedId)});
            clientCursor.moveToFirst();
            loginBox.setText(clientCursor.getString(4));
            passwordBox.setText(clientCursor.getString(5));
            clientCursor.close();
        }
    }
    public void changeLogin(View view){
        if (loginBox.getText().toString().isEmpty())
        {
            messageBox.setText("Ошибка. Пустое поле с логином");
        } else {
            clientCursor = db2.rawQuery("SELECT * FROM clients WHERE login = ?", new String[]{ loginBox.getText().toString()});
            clientCursor.moveToFirst();

            if (clientCursor.getCount() == 0)
            {
                ContentValues cv = new ContentValues();
                cv.put("login", loginBox.getText().toString());
                db2.update("clients", cv, "_id =" + selectedId, null);
                messageBox.setText("Логин изменен");
            } else {
                messageBox.setText("Ошибка. Логин занят");
            }
            clientCursor.close();
        }
    }
    public void changePassword(View view){
        if (passwordBox.getText().toString().isEmpty())
        {
            messageBox.setText("Ошибка. Пустое поле с паролем");
        } else {
            ContentValues cv = new ContentValues();
            cv.put("password", passwordBox.getText().toString());
            db2.update("clients", cv, "_id =" + selectedId, null);
            messageBox.setText("Пароль изменен");
        }
    }
    public void goMap(View view){
        db2.close();
        Intent intent = new Intent(this, MapActivity.class);
        intent.putExtra("user_id", selectedId);
        intent.putExtra("filter1", checkFilter1.isChecked());
        startActivity(intent);
    }
}
