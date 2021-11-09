package com.example.e_majer;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.os.Bundle;
import android.view.MenuItem;

import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.google.android.material.navigation.NavigationBarView;

public class MainActivity extends AppCompatActivity {

    BottomNavigationView bottomNavigation;  // Mendeklarasikan bottom navigation
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        bottomNavigation = findViewById(R.id.bottom_navigation);

        getSupportFragmentManager().beginTransaction().replace(R.id.body_container, new homeFragment()).commit();

        // Memberi action pada saat bottom diklik
        bottomNavigation.setOnItemSelectedListener(new NavigationBarView.OnItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem item) {
                // Memanggil fragment ketika bottom di klik
                Fragment selectedFragment = null;   // Membuat objek fragment dan memberi nilai awal 0

                switch (item.getItemId()){
                    case R.id.home_menu:
                        selectedFragment = new homeFragment();
                        break;
                    case R.id.mading_menu:
                        selectedFragment = new madingFragment();
                        break;
                    case R.id.account_menu:
                        selectedFragment = new accountFragment();
                        break;
                }

                getSupportFragmentManager().beginTransaction().replace(R.id.body_container, selectedFragment).commit();

                return true;
            }
        });
    }
}