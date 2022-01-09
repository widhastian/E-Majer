package com.pina.emajer_v2;

import android.content.Intent;
import android.os.Bundle;

import androidx.cardview.widget.CardView;
import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.pina.emajer_v2.Activity.Transaksi.CatatanPengeluaran.catatanpengeluaran;
import com.pina.emajer_v2.Activity.Transaksi.PembayaranKas.pembayarankas;
import com.pina.emajer_v2.Activity.Transaksi.RiwayatTransaksi.riwayatTransaksi;


public class homeFragment extends Fragment {

   CardView btnPembayaranKas, btnRiwayatTransaksi, btnCttPengeluaran;
    private  View view;

    public homeFragment() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        view = inflater.inflate(R.layout.activity_home, container, false);

        btnPembayaranKas = view.findViewById(R.id.btn_bayar_kas);
        btnRiwayatTransaksi = view.findViewById(R.id.btn_riwayat_transaksi);
        btnCttPengeluaran = view.findViewById(R.id.btn_catatan_pengeluaran);

        intentBtn();

        return view;
    }

    public void intentBtn(){
        btnPembayaranKas.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(getActivity(), pembayarankas.class));
            }
        });

        btnRiwayatTransaksi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(getActivity(), riwayatTransaksi.class));
            }
        });

        btnCttPengeluaran.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(getActivity(), catatanpengeluaran.class));
            }
        });

    }

}