package com.kelompok.e_majer;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {

    TextView editTextEmail, editTextName;
    SessionManager sessionManager;
    String email, name;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        sessionManager = new SessionManager(MainActivity.this);
        if(!sessionManager.isLoggedIn()){
            moveToLogin();
        }

        editTextEmail = findViewById(R.id.etMainEmail);
        editTextName = findViewById(R.id.etMainName);

        email = sessionManager.getUserDetail().get(SessionManager.EMAIL);
        name = sessionManager.getUserDetail().get(SessionManager.NAME);

        editTextEmail.setText(email);
        editTextName.setText(name);

    }

    private void moveToLogin() {
        Intent intent = new Intent(MainActivity.this,LoginActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_NO_HISTORY);
        startActivity(intent);
        finish();
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu, menu);
        return super.onCreateOptionsMenu(menu);
    }

    @Override
    public boolean onOptionsItemSelected(@NonNull MenuItem item) {
        switch (item.getItemId()){
            case R.id.actionLogout:
                sessionManager.logoutSession();
                moveToLogin();
        }
        return super.onOptionsItemSelected(item);
    }
}