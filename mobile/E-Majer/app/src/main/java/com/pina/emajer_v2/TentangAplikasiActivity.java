package com.pina.emajer_v2;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

public class TentangAplikasiActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tentang_aplikasi);
    }

    public void profil(View v){
        startActivity(new Intent(TentangAplikasiActivity.this, ProfilActivity.class));
    }
}