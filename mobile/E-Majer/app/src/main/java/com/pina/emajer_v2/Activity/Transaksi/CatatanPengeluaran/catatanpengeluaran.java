package com.pina.emajer_v2.Activity.Transaksi.CatatanPengeluaran;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import com.pina.emajer_v2.API.APIRequestCatatanPengeluaran;
import com.pina.emajer_v2.API.APIUtils;
import com.pina.emajer_v2.API.ApiLoginRegister;
import com.pina.emajer_v2.API.ApiPengeluaran;
import com.pina.emajer_v2.API.RetrofitClient;
import com.pina.emajer_v2.Activity.Transaksi.RiwayatTransaksi.riwayatTransaksi;
import com.pina.emajer_v2.Adapter.CatatanPengeluaranAdapter;
import com.pina.emajer_v2.Adapter.RiwayatTransaksiAdapter;
import com.pina.emajer_v2.EditProfilActivity;
import com.pina.emajer_v2.HomeActivity;
import com.pina.emajer_v2.Model.CatatanPengeluaran.DataPengeluaran;
import com.pina.emajer_v2.Model.CatatanPengeluaran.DataPengeluaranResponse;
import com.pina.emajer_v2.Model.DataModel;
import com.pina.emajer_v2.Model.ResponseModel;
import com.pina.emajer_v2.Model.RiwayatTransaksi.RiwayatResponse;
import com.pina.emajer_v2.ProfilActivity;
import com.pina.emajer_v2.R;
import com.pina.emajer_v2.SessionManager;
import com.pina.emajer_v2.TentangAplikasiActivity;

import java.text.NumberFormat;
import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class catatanpengeluaran extends AppCompatActivity {

    SessionManager SessionManager;
    APIRequestCatatanPengeluaran apiRequestCatatanPengeluaran;
    RecyclerView recyclerView;
    private RecyclerView.LayoutManager lmData;
    List<DataPengeluaran> dataPengeluaran = new ArrayList<>();
    TextView jumlah_saldo;
    String Saldo = "0";
    private Context ctx;
    private List<DataModel> listData;
    private List<DataModel> listSaldo;
    private String id_kelas;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_catatanpengeluaran);
        apiRequestCatatanPengeluaran = APIUtils.getReqCatatanPengeluaran();
        SessionManager = new SessionManager(this);
        id_kelas = String.valueOf(SessionManager.getIdKelas());
        jumlah_saldo = findViewById(R.id.cp_saldoKelas);
        getDataSaldo();
        buildDataPengeluaran();
    }

    private void initRecyclerView(){
        recyclerView = findViewById(R.id.cp_recycler);
        recyclerView.setHasFixedSize(true);
        LinearLayoutManager linearLayoutManager = new LinearLayoutManager(catatanpengeluaran.this, LinearLayoutManager.VERTICAL, false);
        recyclerView.setLayoutManager(linearLayoutManager);
    }

    private void buildDataPengeluaran(){
        APIRequestCatatanPengeluaran ardData = RetrofitClient.getClient1().create(APIRequestCatatanPengeluaran.class);
        Call<DataPengeluaranResponse> ambilData = ardData.ambilAllPengeluaran(id_kelas);
        ambilData.enqueue(new Callback<DataPengeluaranResponse>() {
            @Override
            public void onResponse(Call<DataPengeluaranResponse> call, Response<DataPengeluaranResponse> response) {
                if (response.isSuccessful()){
                    int kode = response.body().getKode();
                    String pesan = response.body().getPesan();
                    dataPengeluaran = response.body().getData();
                    initRecyclerView();

                    CatatanPengeluaranAdapter adapter = new CatatanPengeluaranAdapter(catatanpengeluaran.this, dataPengeluaran);
                    recyclerView.setAdapter(adapter);
                    adapter.notifyDataSetChanged();

//                    Toast.makeText(getBaseContext(), "Pesan: "+ msg+" | Saldo: "+saldoKelas, Toast.LENGTH_SHORT).show();

                }else{
                    Toast.makeText(getBaseContext(), "Gagal ambil Riwayat Transaksi", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<DataPengeluaranResponse> call, Throwable t) {
                Toast.makeText(getBaseContext(), "Gagal konek server: "+ t.getLocalizedMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    public String formatRupiah(Double number){
        Locale localeID = new Locale("in", "ID");
        NumberFormat formatRupiah = NumberFormat.getCurrencyInstance(localeID);
        return formatRupiah.format(number);
    }

    private void getDataSaldo() {
        ApiPengeluaran ardData = RetrofitClient.getClient1().create(ApiPengeluaran.class);
        Call<ResponseModel> ambilData = ardData.ardGetDataSaldo(id_kelas);

        ambilData.enqueue(new Callback<ResponseModel>() {
            @Override
            public void onResponse(Call<ResponseModel> call, Response<ResponseModel> response) {
                int kode = response.body().getKode();
                String pesan = response.body().getPesan();
                listSaldo = response.body().getData();

                Saldo = listSaldo.get(0).getJumlah_saldo();
                jumlah_saldo.setText(" "+formatRupiah(Double.parseDouble(Saldo))+";-");
            }

            @Override
            public void onFailure(Call<ResponseModel> call, Throwable t) {
                Toast.makeText(ctx, "Gagal Menghubungi Server : " + t.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    public void back(View v){
        startActivity(new Intent(catatanpengeluaran.this, HomeActivity.class));
    }
}