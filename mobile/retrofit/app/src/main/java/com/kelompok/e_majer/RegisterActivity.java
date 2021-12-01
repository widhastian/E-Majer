package com.kelompok.e_majer;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.kelompok.e_majer.api.ApiClient;
import com.kelompok.e_majer.api.ApiInterface;
import com.kelompok.e_majer.model.register.Register;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class RegisterActivity extends AppCompatActivity implements View.OnClickListener {

    EditText editTextEmail, editTextPassword, editTextName, editTextKelas;
    Button btnRegister;
    TextView tvLogin;
    String Email, Password, Name, ConfirmPassword, Kelas;
    ApiInterface apiInterface;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        editTextEmail = findViewById(R.id.editTextRegisterEmail);
        editTextPassword = findViewById(R.id.editTextRegisterPassword);
        editTextName = findViewById(R.id.editTextRegisterName);
        editTextKelas = findViewById(R.id.editTextRegisterKelas);
        btnRegister = findViewById(R.id.btnRegister);
        btnRegister.setOnClickListener(this);

        tvLogin = findViewById(R.id.tvLoginHere);
        tvLogin.setOnClickListener(this);

    }

    @Override
    public void onClick(View view) {
        switch (view.getId()){
            case R.id.btnRegister:
                Email = editTextEmail.getText().toString();
                Password = editTextPassword.getText().toString();
                Name = editTextName.getText().toString();
                Kelas = editTextKelas.getText().toString();
                register(Email, Password, Name, Kelas);
                break;
            case R.id.tvLoginHere:
                Intent intent = new Intent(this, LoginActivity.class);
                startActivity(intent);
                finish();
                break;
        }
    }
    public void submitByRetrofit(User user){

        ProgressDialog proDialog = new ProgressDialog(this);
        proDialog.setTitle(getString(R.string.retrofit));
        proDialog.setMessage("Sedang Disubmit");
        proDialog.show();


        Retrofit.Builder builder= new Retrofit.Builder().baseUrl("http://192.168.43.179/volley/").addConverterFactory(GsonConverterFactory.create());

        Retrofit retrofit = builder.build();
        MethodHTTP client= retrofit.create(MethodHTTP.class);
        Call<Request> call =client.sendUser(user);

        call.enqueue(new Callback<Request>() {
            @Override
            public void onResponse(Call<Request> call, Response<Request> response) {
                proDialog.dismiss();
                if (response.body()!=null){
                    if(response.body().getCode() ==201){
                        Toast.makeText(getApplicationContext(), "Response : "+response.body().getStatus(), Toast.LENGTH_SHORT).show();
                        finish();
                    }else if (response.body().getCode()==406){
                        Toast.makeText(getApplicationContext(), "Response : "+response.body().getStatus(), Toast.LENGTH_SHORT).show();
                        edtEmail.requestFocus();
                    }else {
                        Toast.makeText(getApplicationContext(), "Response : "+response.body().getStatus(), Toast.LENGTH_SHORT).show();
                        finish();
                    }
                }
                Log.e(TAG,"Error : "+response.message());
            }

            @Override
            public void onFailure(Call<Request> call, Throwable t) {

                proDialog.dismiss();
                Log.e(TAG,"Error2 : "+t.getMessage());
            }
        });
    }


    }
}