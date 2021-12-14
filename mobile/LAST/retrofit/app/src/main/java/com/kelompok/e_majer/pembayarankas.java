package com.kelompok.e_majer;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import androidx.appcompat.app.AppCompatActivity;

public class pembayarankas extends AppCompatActivity {
    Button btnDetailkas;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pembayarankas);
        btnDetailkas = findViewById(R.id.toDetailKas);

        btnDetailkas.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(getBaseContext(), detailpembayarankas.class);
                getBaseContext().startActivity(i);
            }
        });
    }
}