package com.example.carsharingapp;

import androidx.appcompat.app.AppCompatActivity;
import android.content.ContentValues;
import android.content.Intent;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;

public class AuthorizationActivity extends AppCompatActivity {
    EditText loginBox;
    EditText passwordBox;
    TextView messageBox;

    ClientsDB sqlHelper;
    SQLiteDatabase db;
    Cursor clientCursor;

    @Override
    protected void onCreate(Bundle savedInstanceState){
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_authorization);

        loginBox = (EditText) findViewById(R.id.editLogin);
        passwordBox = (EditText) findViewById(R.id.editPassword);
        messageBox = (TextView) findViewById(R.id.messageLabel);

        sqlHelper = new ClientsDB(this);
        db = sqlHelper.getWritableDatabase();
    }

    public void pushReg(View view){
        if (loginBox.getText().toString().isEmpty() || passwordBox.getText().toString().isEmpty())
        {
            messageBox.setText("Ошибка. Не все поля заполнены");
        } else {
            clientCursor = db.rawQuery("SELECT * FROM clients WHERE login = ?", new String[]{loginBox.getText().toString()});
            clientCursor.moveToFirst();

            if (clientCursor.getCount() == 0)
            {
                ContentValues cv = new ContentValues();
                cv.put("login", loginBox.getText().toString());
                cv.put("password", passwordBox.getText().toString());
                db.insert("clients", null, cv);

                messageBox.setText("Успешная регистрация");
            } else {
                messageBox.setText("Ошибка. Логин занят");
            }
            clientCursor.close();
        }
    }
    public void pushAuthor(View view){
        if (loginBox.getText().toString().isEmpty() || passwordBox.getText().toString().isEmpty())
        {
            messageBox.setText("Ошибка. Не все поля заполнены");
        } else {
            clientCursor = db.rawQuery("SELECT * FROM clients WHERE login = ? AND password = ?", new String[]{
                    loginBox.getText().toString(),
                    passwordBox.getText().toString()});
            clientCursor.moveToFirst();

            if (clientCursor.getCount() == 0)
            {
                messageBox.setText("Ошибка. Неверный логин или пароль");
            } else {
                Long id = clientCursor.getLong(0);

                clientCursor.close();
                goMap(id);
            }
            clientCursor.close();
        }
    }
    public void goMap(Long id){
        db.close();
        Intent intent = new Intent(this, MapActivity.class);
        intent.putExtra("user_id", id);
        intent.putExtra("filter1", false);
        startActivity(intent);
    }
}
