package com.pina.emajer_v2;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.pina.emajer_v2.API.ApiLoginRegister;
import com.pina.emajer_v2.API.RetrofitClient;
import com.pina.emajer_v2.Model.DataModel;
import com.pina.emajer_v2.Model.ResponseModel;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class EditProfilActivity extends AppCompatActivity {
    private String xId, xNama, xEmail, xUsername, xPassword, xKelas;
    private EditText etNama, etEmail, etUsername, etPassword, etKelas;
    private Button btnUbah;
    private String yNama, yEmail, yUsername, yPassword, yKelas;
    SessionManager SessionManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_profil);

        SessionManager = new SessionManager(this);
        Intent terima = getIntent();
        xId = terima.getStringExtra("xId");
        xNama = terima.getStringExtra("xNama");
        xEmail= terima.getStringExtra("xEmail");
        xUsername = terima.getStringExtra("xUsername");
        xPassword = terima.getStringExtra("xPassword");
        xKelas = terima.getStringExtra("xKelas");

        etNama = findViewById(R.id.et_edit_nama);
        etEmail= findViewById(R.id.et_edit_email);
        etUsername = findViewById(R.id.et_edit_username);
        etPassword = findViewById(R.id.et_edit_password);
        etKelas = findViewById(R.id.et_edit_kelas);
        btnUbah = findViewById(R.id.btn_simpan_edit_profil);

        etNama.setText(xNama);
        etEmail.setText(xEmail);
        etUsername.setText(xUsername);
        etPassword.setText(xPassword);
        etKelas.setText(xKelas);

        btnUbah.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                yNama = etNama.getText().toString();
                yEmail = etEmail.getText().toString();
                yUsername = etUsername.getText().toString();
                yPassword = etPassword.getText().toString();
                yKelas = etKelas.getText().toString();

                updateData();
            }
        });
    }

    private void updateData(){
        ApiLoginRegister ardData = RetrofitClient.getClient1().create(ApiLoginRegister.class);
        Call<ResponseModel> ubahData = ardData.ardUpdateData(xId, yNama, yEmail, yUsername, yPassword, yKelas);

        ubahData.enqueue(new Callback<ResponseModel>() {
            @Override
            public void onResponse(Call<ResponseModel> call, Response<ResponseModel> response) {
                int kode = response.body().getKode();
                String pesan = response.body().getPesan();

                Toast.makeText(EditProfilActivity.this, "Kode : "+kode+" | Pesan : "+pesan, Toast.LENGTH_SHORT).show();
                finish();
            }

            @Override
            public void onFailure(Call<ResponseModel> call, Throwable t) {
                Toast.makeText(EditProfilActivity.this, "Gagal Menghubungi Server | "+t.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    public void profil(View v){
        startActivity(new Intent(EditProfilActivity.this, ProfilActivity.class));
    }
}