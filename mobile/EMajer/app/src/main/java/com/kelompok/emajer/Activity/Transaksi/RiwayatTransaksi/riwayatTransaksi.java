package com.kelompok.emajer.Activity.Transaksi.RiwayatTransaksi;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.Toast;

import com.kelompok.emajer.API.APIRequestRiwayatTransaksi;
import com.kelompok.emajer.API.APIUtils;
import com.kelompok.emajer.Adapter.RiwayatTransaksiAdapter;
import com.kelompok.emajer.HomeActivity;
import com.kelompok.emajer.Model.RiwayatTransaksi.RiwayatAll;
import com.kelompok.emajer.Model.RiwayatTransaksi.RiwayatResponse;
import com.kelompok.emajer.R;
import com.kelompok.emajer.SessionManager;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;


public class riwayatTransaksi extends AppCompatActivity {

    APIRequestRiwayatTransaksi apiRequestRiwayatTransaksi;
    String id_user;
    List<RiwayatAll> riwayatAll = new ArrayList<>();
    RecyclerView recyclerView;
    SessionManager SessionManager;
    ImageView btnBack;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_riwayat_transaksi);
        SessionManager = new SessionManager(this);
        id_user = String.valueOf(SessionManager.getUserId());
        apiRequestRiwayatTransaksi = APIUtils.getReqRiwayatTransaksi();
        buildDataRiwayat();
        getFindId();
        setBtnOnClick();
    }

    private void getFindId(){
        btnBack = findViewById(R.id.rwyt_btnBack);
    }

    private void setBtnOnClick(){
        btnBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(riwayatTransaksi.this, HomeActivity.class));
            }
        });
    }

    private void initRecyclerView(){
        recyclerView = findViewById(R.id.riwayat_recyler);
        recyclerView.setHasFixedSize(true);
        LinearLayoutManager linearLayoutManager = new LinearLayoutManager(riwayatTransaksi.this, LinearLayoutManager.VERTICAL, false);
        recyclerView.setLayoutManager(linearLayoutManager);

    }

    private void buildDataRiwayat(){
        Call<RiwayatResponse> call = apiRequestRiwayatTransaksi.ambilRiwayatTrans(id_user);
        call.enqueue(new Callback<RiwayatResponse>() {
            @Override
            public void onResponse(Call<RiwayatResponse> call, Response<RiwayatResponse> response) {
                if (response.isSuccessful()){
                    int kode = response.body().getKode();
                    String msg = response.body().getMessage();
                    riwayatAll = response.body().getRiwayatAll();
                    initRecyclerView();

                    RiwayatTransaksiAdapter adapter = new RiwayatTransaksiAdapter(riwayatTransaksi.this, riwayatAll);
                    recyclerView.setAdapter(adapter);
                    adapter.notifyDataSetChanged();

//                    Toast.makeText(getBaseContext(), "Pesan: "+ msg, Toast.LENGTH_SHORT).show();

                }else{
                    Toast.makeText(getBaseContext(), "Gagal ambil Riwayat Transaksi", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<RiwayatResponse> call, Throwable t) {
                Toast.makeText(getBaseContext(), "Gagal konek server: "+ t.getLocalizedMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }



}