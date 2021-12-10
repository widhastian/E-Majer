package com.example.e_majer;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

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