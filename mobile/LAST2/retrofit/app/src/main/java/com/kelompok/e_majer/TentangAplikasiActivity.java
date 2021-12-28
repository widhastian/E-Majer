package com.kelompok.e_majer;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;

import androidx.appcompat.app.AppCompatActivity;

public class TentangAplikasiActivity extends AppCompatActivity {
    ImageButton btnBack;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tentang_aplikasi);

        btnBack = (ImageButton) findViewById(R.id.btn_back_tentang_aplikasi);

        btnBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(TentangAplikasiActivity.this, ProfilActivity.class));
            }
        });
    }
}
