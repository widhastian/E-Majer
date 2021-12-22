package com.kelompok.e_majer;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.TextView;
import android.content.pm.ApplicationInfo;
import android.net.Uri;

import androidx.appcompat.app.AppCompatActivity;

import java.io.File;

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
        btnTentang = (Button) findViewById(R.id.btn_tentang_aplikasi);
        btnShare = (Button) findViewById(R.id.btn_share_emajer);

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

        btnTentang.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(ProfilActivity.this, TentangAplikasiActivity.class));
            }
        });

        btnShare.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                setShare();
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

    private void setShare()
    {
        Intent wa = new Intent(Intent.ACTION_SEND);
        wa.setType("text/plain");
        wa.putExtra(Intent.EXTRA_TEXT,
                "Anda dapat mendownload Aplikasi Android");
        wa.setPackage("com.whatsapp");
        startActivity(wa);

    }
}
