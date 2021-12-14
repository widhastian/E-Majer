package com.kelompok.e_majer;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageButton;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;
import com.kelompok.e_majer.SessionManager;

public class HomeActivity extends AppCompatActivity {
    TextView tvNama;
    ImageButton btnProfil;
    SessionManager SessionManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        SessionManager = new SessionManager(this);
        tvNama = (TextView) findViewById(R.id.editTextMainName);
        btnProfil = (ImageButton) findViewById(R.id.btn_account_home);

        tvNama.setText("Selamat Datang di E-Majer, " + SessionManager.getName());

        btnProfil.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(HomeActivity.this, ProfilActivity.class));
            }
        });
    }

}
