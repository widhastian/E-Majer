package com.kelompok.e_majer;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;

import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.google.android.material.navigation.NavigationBarView;

public class MainActivity extends AppCompatActivity {

    TextView etUsername, etName;
    TextView keluar;
    SessionManager sessionManager;
    String username, name;
    BottomNavigationView bottomNavigation;  // Mendeklarasikan bottom navigation

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        bottomNavigation = findViewById(R.id.bottom_navigation);

        getSupportFragmentManager().beginTransaction().replace(R.id.body_container, new HomeFragment()).commit();
        sessionManager = new SessionManager(MainActivity.this);
        if(!sessionManager.isLoggedIn()){
            moveToLogin();
        }

        etUsername = findViewById(R.id.etMainUsername);
        etName = findViewById(R.id.etMainName);

        username = sessionManager.getUserDetail().get(SessionManager.USERNAME);
        name = sessionManager.getUserDetail().get(SessionManager.NAME);

        etUsername.setText(username);
        etName.setText(name);

        // Memberi action pada saat bottom diklik
        bottomNavigation.setOnItemSelectedListener(new NavigationBarView.OnItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem item) {
                // Memanggil fragment ketika bottom di klik
                Fragment selectedFragment = null;   // Membuat objek fragment dan memberi nilai awal 0

                switch (item.getItemId()){
                    case R.id.home_menu:
                        selectedFragment = new HomeFragment();
                        break;
                    case R.id.mading_menu:
                        selectedFragment = new MadingFragment();
                        break;
                    case R.id.account_menu:
                        selectedFragment = new ProfilFragment();
                        break;
                }

                getSupportFragmentManager().beginTransaction().replace(R.id.body_container, selectedFragment).commit();

                return true;
            }
        });

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
            case R.id.keluar:t:
                sessionManager.logoutSession();
                moveToLogin();
        }
        return super.onOptionsItemSelected(item);
    }

}