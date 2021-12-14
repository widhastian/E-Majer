package com.kelompok.e_majer;

import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.util.Patterns;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.google.gson.JsonObject;
import com.kelompok.e_majer.api.ApiClient;
import com.kelompok.e_majer.api.ApiInterface;

import org.json.JSONException;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class EditProfilActivity extends AppCompatActivity {

    EditText etNama, etEmail, etUsername, etPassword, etKelas;
    SessionManager SessionManager;
    Button btnSimpan;
    ImageButton btnBack;
    Dialog dialog;
    ProgressDialog progressDialog;
    ApiInterface api;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_profil);

        btnSimpan = (Button) findViewById(R.id.btn_simpan_edit_profil);
        btnBack = (ImageButton) findViewById(R.id.btn_back_edit_profile);
        etNama = (EditText) findViewById(R.id.et_edit_nama);
        etEmail = (EditText) findViewById(R.id.et_edit_email);
        etUsername = (EditText) findViewById(R.id.et_edit_username);
        etPassword = (EditText) findViewById(R.id.et_edit_password);
        etKelas = (EditText) findViewById(R.id.et_edit_kelas);

        SessionManager = new SessionManager(this);
        etNama.setText(SessionManager.getName());
        etEmail.setText(SessionManager.getEmail());
        etUsername.setText(SessionManager.getUsername());
        etPassword.setText(SessionManager.getPassword());
        etKelas.setText(SessionManager.getKelas());

        btnBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(EditProfilActivity.this, ProfilActivity.class));
            }
        });

        btnSimpan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
            }
        });
    }

    private void showDialog() {
        dialog.setContentView(R.layout.alert_dialog_simpan);
        dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

        Button btnYes = dialog.findViewById(R.id.btn_yes);
        Button btnNo = dialog.findViewById(R.id.btn_no);

        dialog.show();

        btnYes.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                formCheck();
                dialog.dismiss();
            }
        });

        btnNo.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                dialog.dismiss();
            }
        });
    }

    private void formCheck() {
        final String user_id = SessionManager.getUserId();
        final String email = etEmail.getText().toString();
        final String password = etPassword.getText().toString();
        final String nama = etNama.getText().toString();
        final String username = etUsername.getText().toString();
        final String kelas = etKelas.getText().toString();

        if (TextUtils.isEmpty(email)) {
            etEmail.setError("Please enter email");
            etEmail.requestFocus();
            return;
        }

        if (!Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
            etEmail.setError("Enter a valid email");
            etEmail.requestFocus();
            return;
        }

        if (TextUtils.isEmpty(nama)) {
            etNama.setError("Please enter your name");
            etNama.requestFocus();
            return;
        }

        if (TextUtils.isEmpty(username)) {
            etUsername.setError("Please enter your username");
            etUsername.requestFocus();
            return;
        }

        UpdateUser(user_id, email, password, nama, username, kelas);
    }

    private void UpdateUser(String user_id, String email, String password, String nama, String username, String kelas) {
        api = ApiClient.getClient().create(ApiInterface.class);
        Call<JsonObject> updateUser = api.updateUser(uid, email, password, nama, nohp, profimg);

        progressDialog.show();

        updateUser.enqueue(new Callback<JsonObject>() {
            @Override
            public void onResponse(Call<JsonObject> call, Response<JsonObject> response) {
                Log.i("Responsestring", response.body().toString());
                if (response.isSuccessful()){
                    if (response.body() != null){
                        Log.i("onSuccess", response.body().toString());
                        String jsonResponse = response.body().toString();
                        try {
                            parseUpdateData(jsonResponse);
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    } else {
                        Log.i("onEmptyResponse", "Returned empty response");//Toast.makeText(getContext(),"Nothing returned",Toast.LENGTH_LONG).show();
                    }
                }
            }

            @Override
            public void onFailure(Call<JsonObject> call, Throwable t) {
                Toast.makeText(EditProfilActivity.this,t.getLocalizedMessage(),Toast.LENGTH_SHORT).show();
            }
        });
    }
}
