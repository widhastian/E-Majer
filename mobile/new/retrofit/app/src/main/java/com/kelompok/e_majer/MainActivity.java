package com.kelompok.e_majer;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.google.android.material.navigation.NavigationBarView;

public class MainActivity extends AppCompatActivity{

    TextView etUsername, etName, etKelas;
    SessionManager sessionManager;
    String username, name, kelas;
    Button btn_keluar;
    BottomNavigationView bottomNavigation;  // Mendeklarasikan bottom navigation

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        bottomNavigation = findViewById(R.id.bottom_navigation);
        btn_keluar = findViewById(R.id.btn_keluar);
//        etName = findViewById(R.id.etProfilName);
        getSupportFragmentManager().beginTransaction().replace(R.id.body_container, new HomeFragment()).commit();

        sessionManager = new SessionManager(MainActivity.this);
        if(!sessionManager.isLoggedIn()){
            moveToLogin();
        }
        etUsername = findViewById(R.id.etMainUsername);
        //etName = findViewById(R.id.etProfilName);


        username = sessionManager.getUserDetail().get(SessionManager.USERNAME);
        name = sessionManager.getUserDetail().get(SessionManager.NAME);


        System.out.println("Namanya bro "+name);

        etUsername.setText(username);
//        etName.setText(name);


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

    public void logout(View v){
        sessionManager.logoutSession();
        Intent intent = new Intent(MainActivity.this,LoginActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_NO_HISTORY);
        startActivity(intent);
        finish();

    }


}