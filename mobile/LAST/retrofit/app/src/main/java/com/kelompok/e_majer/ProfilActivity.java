package com.kelompok.e_majer;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

public class ProfilActivity extends AppCompatActivity {
    SessionManager SessionManager;
    TextView tvNama, tvKelas;
    ImageButton btnHome;
    Button btnKeluar, btnProfil, btnTentang, btnShare;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profil);

        tvNama = (TextView) findViewById(R.id.etProfilName);
        tvKelas = (TextView) findViewById(R.id.etProfilKelas);
        btnHome = (ImageButton) findViewById(R.id.btn_home_profil);
        btnKeluar = (Button) findViewById(R.id.btn_keluar);
        btnProfil = (Button) findViewById(R.id.btn_setting_profil);

        SessionManager = new SessionManager(this);
        tvNama.setText(SessionManager.getName());
        tvKelas.setText(SessionManager.getKelas());

        btnHome.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(ProfilActivity.this, HomeActivity.class));
            }
        });

        btnProfil.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
               startActivity(new Intent(ProfilActivity.this, EditProfilActivity.class));
            }
        });
    }

    public void logout(View v){
        SessionManager.logoutSession();
        Intent intent = new Intent(ProfilActivity.this,LoginActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_NO_HISTORY);
        startActivity(intent);
        finish();

    }
}
