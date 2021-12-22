package com.kelompok.e_majer;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.webkit.RenderProcessGoneDetail;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import com.kelompok.e_majer.api.ApiClient;
import com.kelompok.e_majer.api.ApiInterface;
import com.kelompok.e_majer.model.login.LoginData;
import com.kelompok.e_majer.model.register.Register;
import com.kelompok.e_majer.model.register.RegisterData;

import java.util.Arrays;
import java.util.concurrent.TimeUnit;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class RegisterActivity extends AppCompatActivity implements View.OnClickListener {

    EditText editTextEmail, editTextPassword, editTextName, editTextKelas, editTextUsername;
    Button btnRegister;
    TextView tvLogin;
    String Email, Password, Name, Kelas, Username;
    ApiInterface apiInterface;
    SessionManager sessionManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        editTextEmail = findViewById(R.id.editTextRegisterEmail);
        editTextPassword = findViewById(R.id.editTextRegisterPassword);
        editTextName = findViewById(R.id.editTextRegisterName);
        editTextKelas = findViewById(R.id.editTextRegisterKelas);
        editTextUsername = findViewById(R.id.editTextRegisterUsername);
        btnRegister = findViewById(R.id.btnRegister);
        btnRegister.setOnClickListener(this);

        tvLogin = findViewById(R.id.tvLoginHere);
        tvLogin.setOnClickListener(this);

    }

    @Override
    public void onClick(View view) {
        switch (view.getId()) {
            case R.id.btnRegister:
                Email = editTextEmail.getText().toString();
                Password = editTextPassword.getText().toString();
                Name = editTextName.getText().toString();
                Kelas = editTextKelas.getText().toString();
                Username = editTextUsername.getText().toString();
                register(Email, Password, Name, Kelas, Username);
                break;
            case R.id.tvLoginHere:
                Intent intent = new Intent(this, LoginActivity.class);
                startActivity(intent);
                finish();
                break;
        }
    }

    private void register(String email, String password, String name, String kelas, String username) {

        apiInterface = ApiClient.getClient().create(ApiInterface.class);
        Call<Register> registerCall = apiInterface.registerResponse(email, password, name, kelas, username);
        registerCall.enqueue(new Callback<Register>() {
            @Override
            public void onResponse(Call<Register> registerCall, Response<Register> response) {
                if (response.body() != null && response.isSuccessful() && response.body().isStatus()) {
//                    System.out.println(response.body());
//                    sessionManager = new SessionManager(RegisterActivity.this);
//                    RegisterData registerData = response.body().getRegisterData();
//                    sessionManager.createRegisterSession(registerData);

                    Toast.makeText(RegisterActivity.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                    Intent intent = new Intent(RegisterActivity.this, LoginActivity.class);
                    startActivity(intent);
                    finish();
                } else {
                    Toast.makeText(RegisterActivity.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<Register> call, Throwable t) {
                Toast.makeText(RegisterActivity.this, t.getLocalizedMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }
}